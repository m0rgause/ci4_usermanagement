<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'group_path';
    protected $allowedFields = ['nama', 'deskripsi', 'landing_page'];

    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
