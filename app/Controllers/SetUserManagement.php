<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\UserModel;
use App\Models\UserApprovalModel;

#[\AllowDynamicProperties]
class SetUserManagement extends BaseController
{
    protected $GroupModel;
    protected $UserModel;
    protected $UserApprovalModel;


    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->GroupModel = new GroupModel();
        $this->UserModel = new UserModel();
        $this->UserApprovalModel = new UserApprovalModel();
    }

    public function index()
    {
        $config = config('Pager');
        $perPage = $config->perPage;

        $currPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $startRow = ($currPage - 1) * $perPage;
        $list = $this->UserModel->select('users.id,users.nama, users.email, users.status, users.last_login, group_path.nama as group_nama')->join('group_path', 'users.group_id = group_path.id')->orderBy('users.nama')->paginate($perPage);

        $data = [
            'userList' => $list,
            'pagination' => $this->UserModel->pager,
            'startRow' => $startRow,
        ];

        return view('Set/UserManagementList', $data);
    }

    public function insert()
    {
        $data = [
            'listGroup' => $this->GroupModel->select()->orderBy('nama')->findAll(),
        ];

        return view('Set/UserInsert', $data);
    }

    public function insert_save()
    {

        if ($this->request->is('post')) {
            $rules = [
                'nama' => 'required|',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[5]',
                'confirmNewPass' => 'required|min_length[5]|matches[password]',
                'group' => 'required',
            ];



            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                $random = env('encryption.key');
                $registToken = bin2hex($this->encrypter->encrypt($random));

                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'email' => $this->request->getVar('email'),
                    'password' => bin2hex($this->encrypter->encrypt($this->request->getVar('password'))),
                    'group_id' => $this->request->getVar('group'),
                    'status' => 1,
                    'register_token' => $registToken,
                ];

                $this->UserModel->save($data);

                return redirect()->route('setusermanagement')->with('success', 'Berhasil tambah data');

                // $tokenLink = site_url('reset/' . $registToken);

                // $message = "
                // Hai, " . $this->request->getVar('nama') . ". <br><br>
                // Klik link di bawah ini untuk mengaktifkan emailmu : <br>
                // <a href='" . base_url('auth/activate_user/' . $registToken) . "'>Aktifkan Email</a> <br><br>
                // Terima kasih.";

                // $emailFunc = \Config\Services::email();
                // $emailFunc->setTo($this->request->getVar('email'));
                // $emailFunc->setFrom('', session()->get('systitle'));
                // $emailFunc->setSubject('Activate Your Email');
                // $emailFunc->setMessage($message);

                // if (!$emailFunc->send()) {
                //     return redirect()->route('setusermanagement')->with('error', 'Gagal mengirim link!');
                // } else {
                //     return redirect()->route('setusermanagement')->with('success', 'Silahkan aktivasi User melalui link di email!');
                // }
            }
        }
    }

    public function update($id)
    {
        $data = [
            'data' => $this->UserModel->where('id', $id)->first(),
            'listGroup' => $this->GroupModel->select()->orderBy('nama')->findAll(),
        ];

        return view('Set/UserUpdate', $data);
    }

    public function update_save($id)
    {
        if ($this->request->is('post')) {
            if ($this->request->getVar('email') == $this->request->getVar('emailOld')) {
                $rules = [
                    'nama' => 'required|',
                    'email' => 'required',
                ];
            } else {
                $rules = [
                    'nama' => 'required|',
                    'email' => 'required|valid_email|is_unique[users.email]',
                ];
            }

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            } else {
                $itb_api_unit = $this->request->getVar('itb_api_unit');
                $itb_api_unit_val = !empty($itb_api_unit) ? implode(',', $itb_api_unit) : null;

                $data = [
                    'id' => $id,
                    'nama' => $this->request->getVar('nama'),
                    'email' => $this->request->getVar('email'),
                    'group_id' => $this->request->getVar('group'),
                    'itb_api_unit' => $itb_api_unit_val,
                ];

                $this->UserModel->save($data);

                return redirect()->route('setusermanagement')->with('success', 'Berhasil simpan data');
            }
        }
    }


    public function delete($id)
    {
        if ($this->GiroModel->where('created_by', $id)->orWhere('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di giro!');
        }

        if ($this->DepositoModel->where('created_by', $id)->orWhere('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di deposito!');
        }

        if ($this->InvestasiModel->where('created_by', $id)->orWhere('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di investasi!');
        }

        if ($this->TrxPenampunganModel->where('created_by', $id)->orWhere('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di penampungan!');
        }

        if ($this->TrxPengeluaranModel->where('created_by', $id)->orWhere('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di pengeluaran!');
        }

        if ($this->TrxUtamaModel->where('created_by', $id)->orWhere('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di utama!');
        }
        if ($this->UserApprovalModel->where('approved_by', $id)->countAllResults() > 0) {
            return redirect()->route('setusermanagement')->with('error', 'Data sudah digunakan di approval!');
        }

        $this->UserModel->delete($id);
        return redirect()->route('setusermanagement')->with('success', 'Berhasil hapus data');
    }

    public function pass_reset($id)
    {
        $data = $this->UserModel->select('id,nama,email')->where('id', $id)->first();
        $data = [
            'data' => $data,
        ];
        return view('Set/UserResetPassword', $data);
    }

    public function pass_reset_self($id)
    {
        $data = $this->UserModel->select('id,nama,email')->where('id', $id)->first();
        $data = [
            'data' => $data,
        ];
        return view('Set/UserResetPasswordSelf', $data);
    }


    public function pass_reset_process($id)
    {
        $newPass = $this->request->getVar('newPassword');
        $rules = [
            'newPassword' => 'required|min_length[5]',
            'confirmNewPass' => 'required|min_length[5]|matches[newPassword]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        } else {
            $data = $this->UserModel->where('id', $id)->first();
            $this->UserModel->save([
                'id' => $data['id'],
                'password' => bin2hex($this->encrypter->encrypt($newPass)),
            ]);
            return redirect()->route('setusermanagement')->with('success', 'Berhasil mengganti password!');
        }
    }

    public function pass_reset_process_self($id)
    {
        $oldPass = $this->request->getVar('oldPassword');
        $newPass = $this->request->getVar('newPassword');
        $rules = [
            'oldPassword' => 'required|min_length[5]',
            'newPassword' => 'required|min_length[5]',
            'confirmNewPass' => 'required|min_length[5]|matches[newPassword]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        } else {
            $data = $this->UserModel->select('password')->where('id', $id)->first();
            if ($this->encrypter->decrypt(hex2bin($data['password'])) == $oldPass) {
                $this->UserModel->save([
                    'id' => $id,
                    'password' => bin2hex($this->encrypter->encrypt($newPass)),
                ]);
                return redirect()->back()->with('success', 'Berhasil mengganti password!');
            } else {
                return redirect()->back()->with('error', 'Password lama tidak cocok!');
            }
        }
    }


    public function approval($id)
    {
        $data = $this->UserModel->select('id,nama,email,group_id')->where('id', $id)->first();
        $users = $this->UserModel
            ->select('users.id,users.nama,users.email,users.group_id, group_path.nama as group_nama')
            ->join('group_path', 'users.group_id = group_path.id')
            ->whereNotIn('users.id', [$id])->findAll();


        $data_approval = $this->UserApprovalModel->select()->where('approved_by', $id)->findAll();
        $slcuser = [];

        if ($data_approval) foreach ($data_approval as $apv) {
            $slcuser[] = $apv['user_id'];
        }

        $data = [
            'data' => $data,
            'users' => $users,
            'slcuser' => $slcuser,
        ];
        return view('Set/UserApproval', $data);
    }


    public function approval_process($id)
    {
        $data_user = $this->request->getVar('user_id');

        $db = \Config\Database::connect();
        $db->transBegin();

        $this->UserApprovalModel->where('approved_by', $id)->delete();
        if ($data_user) foreach ($data_user as $user_id) {
            $this->UserApprovalModel->save([
                'approved_by' => $id,
                'user_id' => $user_id,
            ]);
        }

        if ($db->transStatus() === false) {
            $db->transRollback();
            return redirect()->route('setusermanagement')->with('error', 'Gagal simpan datta!');
        } else {
            $db->transCommit();
            return redirect()->route('setusermanagement')->with('success', 'Berhasil simpan data!');
        }
    }
}
