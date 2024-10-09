<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\AccessModel;
use App\Models\GroupAccessModel;
use App\Models\UserModel;


#[\AllowDynamicProperties]
class SetGroup extends BaseController
{
    protected $GroupModel, $AccessModel, $GroupAccessModel, $UserModel;

    public function __construct()
    {
        $this->GroupModel = new GroupModel();
        $this->AccessModel = new AccessModel();
        $this->GroupAccessModel = new GroupAccessModel();
        $this->UserModel = new UserModel();
    }


    public function index()
    {
        $data = [
            'groupList' => $this->GroupModel->select('id,nama,deskripsi,landing_page')->orderBy('nama')->findAll(),
        ];

        return view('Set/GroupList', $data);
    }

    public function insert()
    {
        $data = [];

        return view('Set/GroupInsert', $data);
    }

    public function insert_save()
    {
        if ($this->request->is('post')) {
            $rules = [
                'nama' => 'required',
                'deskripsi' => 'required',
                'landing_page' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                $this->GroupModel->save([
                    'nama' => $this->request->getVar('nama'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'landing_page' => $this->request->getVar('landing_page'),
                ]);

                return redirect()->route('setgroup')->with('success', 'Berhasil simpan data');
            }
        }
    }


    public function update($id)
    {
        $data = [
            'data' => $this->GroupModel->where('id', $id)->first(),
        ];
        return view('Set/GroupUpdate', $data);
    }

    public function update_save($id)
    {
        if ($this->request->is('post')) {
            $rules = [
                'nama' => 'required',
                'deskripsi' => 'required',
                'landing_page' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                $this->GroupModel->save([
                    'id' => $id,
                    'nama' => $this->request->getVar('nama'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'landing_page' => $this->request->getVar('landing_page'),
                ]);


                return redirect()->route('setgroup')->with('success', 'Berhasil simpan data');
            }
        }
    }


    public function delete($id)
    {
        if ($this->UserModel->where('group_id', $id)->countAllResults() > 0) {
            return redirect()->route('setgroup')->with('error', 'Data sudah digunakan di User!');
        }

        if ($this->GroupAccessModel->where('group_id', $id)->countAllResults() > 0) {
            return redirect()->route('setgroup')->with('error', 'Data sudah digunakan di Group Access!');
        }
        $this->GroupModel->delete($id);
        return redirect()->route('setgroup')->with('success', 'Berhasil hapus data');
    }


    public function access($id)
    {
        $data_access = [];

        // access parent
        $parent_data = $this->AccessModel->select('id, urutan, nama')->where('pid', null)->orWhere('pid', '')->orderBy('urutan')->findAll();
        foreach ($parent_data as $pid => $parent) {
            $data_access[$pid] = $parent;


            // subparent
            $subparent_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $parent['id'])->orderBy('urutan')->findAll();
            foreach ($subparent_data as $subid => $subparent) {
                $data_access[$pid]['sub'][$subid] = $subparent;

                // child
                $child_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $subparent['id'])->orderBy('urutan')->findAll();
                foreach ($child_data as $child) {
                    $data_access[$pid]['sub'][$subid]['child'][] = $child;
                }
            }
        }
        //end access parent

        $data_group = $this->GroupModel->where('id', $id)->first();
        $data_group_access = $this->GroupAccessModel->select()->where('group_id', $id)->findAll();

        $slcaccess = [];
        if ($data_group_access) foreach ($data_group_access as $group) {
            $slcaccess[] = $group['access_id'];
        }

        $data = [
            'data_group' => $data_group,
            'data_access' => $data_access,
            'slcaccess' => $slcaccess,
        ];

        return view('Set/GroupAccess', $data);
    }

    public function access_process($id)
    {
        $accesses = $this->request->getVar('access_id');

        $db = \Config\Database::connect();
        $db->transBegin();

        $this->GroupAccessModel->where('group_id', $id)->delete();

        if ($accesses) foreach ($accesses as $data) {
            $this->GroupAccessModel->save([
                'group_id' => $id,
                'access_id' => $data,
            ]);
        }

        $this->access_gen($id);
        if ($db->transStatus() === false) {
            $db->transRollback();
            return redirect()->route('setgroup')->with('error', 'Gagal simpan data!');
        } else {
            $db->transCommit();
            return redirect()->route('setgroup')->with('success', 'Berhasil simpan data!');
        }
    }


    public function access_gen($id)
    {
        $access_data = [];

        // parent
        $parent_data = $this->GroupAccessModel->select('access_path.id as access_id, access_path.nama, access_path.link,access_path.icon')->join('access_path', 'group_access.access_id = access_path.id')->where('group_id', $id)->where('access_path.pid', null)->orWhere('access_path.pid', '')->orderBy('urutan')->findAll();
        foreach ($parent_data as $pid => $parent) {
            $access_data[$pid] = $parent;

            // subparent
            $subparent_data =  $this->GroupAccessModel
                ->select('access_path.id as access_id, access_path.nama, access_path.link,access_path.icon')
                ->join('access_path', 'group_access.access_id = access_path.id')
                ->where('group_id', $id)
                ->where('access_path.pid', $parent['access_id'])
                ->orderBy('urutan')
                ->findAll();
            foreach ($subparent_data as $subid => $subparent) {
                $access_data[$pid]['sub'][$subid] = $subparent;

                // child
                $child_data =  $this->GroupAccessModel->select('access_path.id as access_id, access_path.nama, access_path.link,access_path.icon')->join('access_path', 'group_access.access_id = access_path.id')->where('group_id', $id)->where('access_path.pid', $subparent['access_id'])->orderBy('urutan')->findAll();
                foreach ($child_data as $child) {
                    $access_data[$pid]['sub'][$subid]['child'][] = $child;
                }
            }
        }

        //write file
        $filecontent = json_encode($access_data);
        $filepath = FCPATH . 'group_access/' . $id . '.txt';
        $file = fopen($filepath, "w") or die("Unable to open file!");
        fwrite($file, $filecontent);
    }
}
