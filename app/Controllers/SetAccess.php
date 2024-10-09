<?php

namespace App\Controllers;

use App\Models\AccessModel;
use App\Models\GroupAccessModel;

#[\AllowDynamicProperties]
class SetAccess extends BaseController
{

    public function __construct()
    {
        $this->AccessModel = new AccessModel();
        $this->GroupAccessModel = new GroupAccessModel();
    }


    public function index()
    {
        $access = [];
        $parent_data = $this->AccessModel->select('id, urutan, nama')->where('pid', null)->orWhere('pid', '')->orderBy('urutan')->findAll();
        foreach ($parent_data as $pid => $parent) {
            $access[$pid] = $parent;

            // subparent
            $subparent_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $parent['id'])->orderBy('urutan')->findAll();
            foreach ($subparent_data as $subid => $subparent) {
                $access[$pid]['sub'][$subid] = $subparent;

                // child
                $child_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $subparent['id'])->orderBy('urutan')->findAll();
                foreach ($child_data as $child) {
                    $access[$pid]['sub'][$subid]['child'][] = $child;
                }
            }
        }

        $data = [
            'access' => $access,
        ];

        return view('Set/AccessList', $data);
    }

    public function insert()
    {
        $access = [];
        // access parent
        $parent_data = $this->AccessModel->select('id, urutan, nama')->where('pid', null)->orWhere('pid', '')->orderBy('urutan')->findAll();

        foreach ($parent_data as $pid => $parent) {
            $access[$pid] = $parent;

            // subparent
            $subparent_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $parent['id'])->orderBy('urutan')->findAll();
            foreach ($subparent_data as $subid => $subparent) {
                $access[$pid]['sub'][$subid] = $subparent;

                // child
                $child_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $subparent['id'])->orderBy('urutan')->findAll();
                foreach ($child_data as $child) {
                    $access[$pid]['sub'][$subid]['child'][] = $child;
                }
            }
        }
        // end access parent

        $data = [
            'access' => $access,
        ];

        return view('Set/AccessInsert', $data);
    }

    public function insert_save()
    {
        $pid = $this->request->getVar('pid');
        $nama = $this->request->getVar('nama');
        $icon = $this->request->getVar('icon');
        $urutan = $this->request->getVar('urutan');
        $link = $this->request->getVar('link');

        if ($this->request->is('post')) {
            $rules = [
                'nama' => 'required',
                'urutan' => 'required|numeric',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                //check same urutan under same pid
                $pid = $this->request->getVar('pid');
                $urutan = $this->request->getVar('urutan');
                $same_urutan = $this->AccessModel->select('id')->where('pid', $pid)->where('urutan', $urutan)->first();
                if (!empty($same_urutan)) {
                    return redirect()->back()->withInput()->with('error', 'Urutan ' . $urutan . ' sudah digunakan pada induk yang sama');
                }

                $db = \Config\Database::connect();
                $db->transBegin();

                $id = guidv4();
                if ($pid != '') {
                    $parent = $this->AccessModel->select('urutan_path')->where('id', $pid)->first();
                    $urutan_path = $parent['urutan_path'] . ',' . substr('0' . $urutan, -2);
                } else {
                    $urutan_path = substr('0' . $urutan, -2);
                }

                $this->AccessModel->insert([
                    'id' => $id,
                    'nama' => $nama,
                    'pid' => $pid,
                    'icon' => $icon,
                    'link' => $link,
                    'urutan' => $urutan,
                    'urutan_path' => $urutan_path,
                ]);

                if ($db->transStatus() === false) {
                    $db->transRollback();
                    return redirect()->route('setaccess')->with('error', 'Gagal simpan data!');
                } else {
                    $db->transCommit();
                    return redirect()->route('setaccess')->with('success', 'Berhasil simpan data');
                }
            }
        }
    }


    public function update($id)
    {
        $access = [];

        // access parent
        $parent_data = $this->AccessModel->select('id, urutan, nama')->where('pid', null)->orderBy('urutan')->findAll();
        foreach ($parent_data as $pid => $parent) {
            $access[$pid] = $parent;

            // subparent
            $subparent_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $parent['id'])->orderBy('urutan')->findAll();
            foreach ($subparent_data as $subid => $subparent) {
                $access[$pid]['sub'][$subid] = $subparent;

                // child
                $child_data =  $this->AccessModel->select('id, urutan, nama')->where('pid', $subparent['id'])->orderBy('urutan')->findAll();
                foreach ($child_data as $child) {
                    $access[$pid]['sub'][$subid]['child'][] = $child;
                }
            }
        }
        // end access parent

        $data = [
            'data' => $this->AccessModel->where('id', $id)->first(),
            'access' => $access,
        ];
        // dd($data);
        return view('Set/AccessUpdate', $data);
    }

    public function update_save($id)
    {
        $pid = $this->request->getVar('pid');
        $nama = $this->request->getVar('nama');
        $icon = $this->request->getVar('icon');
        $urutan = $this->request->getVar('urutan');
        $link = $this->request->getVar('link');

        if ($this->request->is('post')) {
            $rules = [
                'nama' => 'required',
                'urutan' => 'required|numeric',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                //check same urutan under same pid
                $pid = $this->request->getVar('pid');
                $pidOld = $this->request->getVar('pid_old');

                $urutan = $this->request->getVar('urutan');
                $urutanOld = $this->request->getVar('urutanOld');
                $urutan_pathOld = $this->request->getVar('urutan_pathOld');

                $same_urutan = $this->AccessModel->select('id')->where('pid', $pid)->where('id !=', $id)->where('urutan', $urutan)->first();
                if (!empty($same_urutan)) {
                    return redirect()->back()->withInput()->with('error', 'Urutan ' . $urutan . ' sudah digunakan pada induk yang sama');
                }

                $db = \Config\Database::connect();
                $db->transBegin();

                // if ($pid != '') {
                //     $parent = $this->AccessModel->select('urutan_path')->where('id', $pid)->first();
                //     $urutan_path = $parent['urutan_path'] . ',' . substr('0' . $urutan, -2);
                // } else {
                //     $urutan_path = substr('0' . $urutan, -2);
                // }

                $this->AccessModel->update($id, [
                    'nama' => $nama,
                    'pid' => $pid,
                    'icon' => $icon,
                    'link' => $link,
                    'urutan' => $urutan,
                    'urutan_path' => '',
                ]);

                //update child urutan_path based on parent urutan
                // $db->query("update access_path set urutan_path = replace(urutan_path, '" . $urutan_pathOld . ",', '" . $urutan_path . ",') where urutan_path LIKE '" . $urutan_pathOld . ",%'");

                if ($db->transStatus() === false) {
                    $db->transRollback();
                    return redirect()->route('setaccess')->with('error', 'Gagal simpan data!');
                } else {
                    $db->transCommit();
                    return redirect()->route('setaccess')->with('success', 'Berhasil simpan data');
                }
            }
        }
    }


    public function delete($id)
    {
        $countChild = $this->GroupAccessModel->where('access_id', $id)->countAllResults();
        if ($countChild > 0) {
            return redirect()->route('setaccess')->with('error', 'Data sudah digunakan di Group Akses!');
        } else {
            $this->AccessModel->delete($id);
            return redirect()->route('setaccess')->with('success', 'Berhasil hapus data');
        }
    }
}
