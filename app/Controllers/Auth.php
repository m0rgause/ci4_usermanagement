<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BisUnitModel;
use App\Models\SystemProfileModel;
use Config\OAuth;
use League\OAuth2\Client\Provider\GenericProvider;

#[\AllowDynamicProperties]
class Auth extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->BisUnitModel = new BisUnitModel();
        $this->SystemProfileModel = new SystemProfileModel();
        $this->encrypter = \Config\Services::encrypter();
    }

    public function login()
    {
        $sysprofile = $this->SystemProfileModel->select('systitle, syslogo')->first();
        $data = [
            'sysprofile' => $sysprofile,
        ];
        return view('Aut/Login2', $data);
    }

    public function login_process()
    {
        // validate google recaptcha v2 
        $recaptcha = $this->request->getVar('g-recaptcha-response');
        $secret = env('captcha.secretKey');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha");
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys["success"]) !== 1) {
            return redirect()->back()->with('error', 'Invalid Captcha!')->withInput();
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        } else {
            $data = $this->UserModel->select('users.*, group_path.landing_page')
                ->join('group_path', 'users.group_id = group_path.id')
                ->where(['email' => $email, 'status' => 1])
                ->first();

            $sysProfile = $this->SystemProfileModel->select('systitle,syslogo,sysname')->first();
            if ($data) {
                if ($password == $this->encrypter->decrypt(hex2bin($data['password']))) {
                    session()->set([
                        'id' => $data['id'],
                        'group_id' => $data['group_id'],
                        'expires_in' => strtotime('+1 hour'),
                        'name' => $data['nama'],
                        'systitle' => $sysProfile['systitle'],
                        'syslogo' => $sysProfile['syslogo'],
                        'sysname' => $sysProfile['sysname'],
                        'isLoggedIn' => TRUE,
                    ]);
                    return redirect()->to($data['landing_page']);
                } else {
                    return redirect()->route('signin')->with('error', 'Invalid Password!');
                }
            } else {
                return redirect()->route('signin')->with('error', 'Email tidak ditemukan atau User tidak aktif!');
            }
        }
    }


    public function pass_forgot()
    {
        $sysprofile = $this->SystemProfileModel->select('systitle,syslogo')->first();
        $data = [
            'sysprofile' => $sysprofile,
        ];
        return view('Aut/ForgotPassword', $data);
    }


    public function pass_forgot_process()
    {
        $recaptcha = $this->request->getVar('g-recaptcha-response');
        $secret = env('captcha.secretKey');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha");
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys["success"]) !== 1) {
            return redirect()->back()->with('error', 'Invalid Captcha!')->withInput();
        }


        $email = $this->request->getVar('email');
        $rules = [
            'email' => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        } else {
            $data = $this->UserModel->where('email', $email)->first();
            $sysprofile = $this->SystemProfileModel->select('systitle,syslogo')->first();
            if ($data) {
                $random = random_int(0, 999999);
                $token = bin2hex($this->encrypter->encrypt($random));

                $this->UserModel->save([
                    'id' => $data['id'],
                    'reset_token' => $token,
                ]);
                $tokenLink = site_url('reset/' . $token);

                $message = "
                Hai, " . $data['nama'] . ". <br><br>
                Klik link di bawah ini untuk melanjutkan proses reset password: <br>
                <a href='" . $tokenLink . "'>Reset Password</a> <br><br>
                Terima kasih.";

                $emailFunc = \Config\Services::email();
                $emailFunc->setFrom('', $sysprofile['systitle']);
                $emailFunc->setTo($email);
                // $emailFunc->attach($attachment);
                $emailFunc->setSubject('Reset Password Information');
                $emailFunc->setMessage($message);

                if (!$emailFunc->send()) {
                    echo 'gagal';
                } else {
                    return redirect()->back()->with('success', 'Berhasil mengirim link, silahkan cek emailmu!');
                }
            } else {
                return redirect()->back()->with('error', 'Email tidak terdaftar!');
            }
        }
    }


    public function pass_reset($token)
    {
        $sysprofile = $this->SystemProfileModel->select('systitle,syslogo')->first();
        $data = $this->UserModel->where('reset_token', $token)->first();
        if ($data) {
            $data = [
                'token' => $token,
                'sysprofile' => $sysprofile,
            ];
            return view('Aut/ResetPassword', $data);
        } else {
            return redirect()->route('forgot')->with('error', 'Link tidak valid!');
        }
    }


    public function pass_reset_process()
    {
        $token = $this->request->getVar('token');
        $newPass = $this->request->getVar('newPassword');
        $rules = [
            'newPassword' => 'required|min_length[5]',
            'confirmNewPass' => 'required|min_length[5]|matches[newPassword]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('reset/' . $token)->withInput()->with('validation', $this->validator);
        } else {
            $data = $this->UserModel->where('reset_token', $token)->first();
            if ($data) {
                $this->UserModel->save([
                    'id' => $data['id'],
                    'password' => bin2hex($this->encrypter->encrypt($newPass)),
                    'reset_token' => null,
                ]);
                return redirect()->to('signin')->with('success', 'Berhasil me-reset password, silahkan sign-in kembali!');
            } else {
                return redirect()->route('reset')->with('error', 'Link tidak valid!');
            }
        }
    }

    public function activate_user($registToken)
    {
        $user = $this->UserModel->select('id')->where('register_token', $registToken)->first();

        if (!empty($user)) {
            $this->UserModel->update($user['id'], [
                'status' => 1,
                'register_token' => null,
            ]);
            return redirect()->to('signin')->with('success', 'Aktivasi berhasil');
        } else {
            return redirect()->to('signin')->with('error', 'Link tidak valid');
        }
    }

    public function logout()
    {
        if (empty(session()->get('id'))) {
            return redirect()->to('signin');
        }

        $this->UserModel->update(session()->get('id'), [
            "last_login" =>  convertTimestampToOracle(date("Y-m-d H:i:s")),
        ]);

        $session = session();
        unset($_SESSION);
        $session->destroy();

        return redirect()->to('signin');
    }
}
