<?php

namespace App\Controllers;

use App\Models\BukuModel;

#[\AllowDynamicProperties]
class Home extends BaseController
{
    protected $BukuModel;

    public function __construct()
    {
        $this->BukuModel = new BukuModel();
    }

    public function index()
    {
        $data = [
            'buku' => $this->BukuModel->findAll(),
        ];
        return view('buku/tambah', $data);
    }

    public function simpan()
    {
        // dd($this->request->getVar('judul'));
        $this->BukuModel->save([
            'judul' => $this->request->getVar('judul'),
        ]);
        return redirect()->to('/');
    }

    public function delete($id)
    {
        // echo 'test';
        $this->BukuModel->delete($id);
        return redirect()->to('/');
    }
}
