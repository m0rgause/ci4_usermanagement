<?php

namespace App\Models;

use CodeIgniter\Model;

class SystemProfileModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sys_profile';
    protected $allowedFields = ['syslogo', 'systitle', 'sysname'];

    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
