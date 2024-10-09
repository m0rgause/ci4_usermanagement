<?php

namespace App\Models;

use CodeIgniter\Model;

class AccessModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'access_path';
    protected $allowedFields = ['id', 'pid', 'nama', 'icon', 'urutan', 'urutan_path', 'link', 'pid_path'];
    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
