<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $allowedFields = ['nama', 'email', 'username', 'password', 'status', 'last_login', 'reset_token', 'register_token', 'group_id'];
    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
