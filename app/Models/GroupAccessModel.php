<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupAccessModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'group_access';
    protected $allowedFields = ['group_id', 'access_id'];

    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}