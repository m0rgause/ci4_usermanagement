<?php

namespace App\Controllers;

use App\Models\SystemProfileModel;

#[\AllowDynamicProperties]
class SetSystemProfile extends BaseController
{
    public function __construct()
    {
        $this->SystemProfileModel = new SystemProfileModel();
    }

    public function index()
    {


        //output
        $data = $this->SystemProfileModel->select('id,syslogo,systitle,sysname')->first();

        $data = [
            'data' => $data,
        ];

        return view('Set/SystemProfile', $data);
    }

    public function update($id)
    {
        $row = $this->SystemProfileModel->where('id', $id)->first();
        $data = [
            'id' => $id,
            'data' => $row,
            'listMutasi' => array('' => 'Debit & Kredit', 'Debit' => 'Debit Only', 'Kredit' => 'Kredit Only'),

        ];
        return view('Set/SystemProfileUpdate', $data);
    }


    public function update_save($id)
    {
        if ($this->request->is('post')) {
            $rules = [
                'systitle' => 'required',
                'sysname' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                $this->SystemProfileModel->update($id, [
                    'systitle' => $this->request->getVar('systitle'),
                    'sysname' => $this->request->getVar('sysname'),
                    'penampungan_mt940_mutasi' => $this->request->getVar('penampungan_mt940_mutasi'),
                    'penampungan_mt940_flag' => $this->request->getVar('penampungan_mt940_flag'),
                    'utama_mt940_mutasi' => $this->request->getVar('utama_mt940_mutasi'),
                    'utama_mt940_flag' => $this->request->getVar('utama_mt940_flag'),
                    'pengeluaran_mt940_mutasi' => $this->request->getVar('pengeluaran_mt940_mutasi'),
                    'pengeluaran_mt940_flag' => $this->request->getVar('pengeluaran_mt940_flag')
                ]);

                return redirect()->route('setsystemprofile')->with('success', 'Berhasil simpan data');
            }
        }
    }

    public function upload($id)
    {
        $bank = $this->SystemProfileModel->where('id', $id)->first();
        $data = [
            'id' => $id,
            'data' => $bank,
        ];

        return view('Set/SystemProfileUpload', $data);
    }


    public function upload_save($id)
    {
        if ($this->request->is('post')) {
            $rules = [
                'logo' => 'uploaded[logo]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,1024]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
            } else {
                $img = $this->request->getFile('logo');
                $newFilename = $id . '.' . $img->getExtension();
                $img->move(FCPATH . 'sysprofile', $newFilename);
                $this->SystemProfileModel
                    ->set('syslogo', $newFilename)
                    ->where('id', $id)->update();

                return redirect()->back()->with('success', 'Berhasil simpan data');
            }
        }
    }


    public function image_delete($id)
    {
        $bank = $this->SystemProfileModel->select('syslogo')->where('id', $id)->first();
        unlink(FCPATH . 'sysprofile/' . $bank['syslogo']);
        $this->SystemProfileModel->set('syslogo', '')->where('id', $id)->update();
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->SystemProfileModel->delete($id);
        return redirect()->route('setsystemprofile')->with('success', 'Berhasil hapus data');
    }
}
