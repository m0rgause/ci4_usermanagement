<?php

namespace App\Models;

use CodeIgniter\Model;

class UserApprovalModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'user_approval';
    protected $allowedFields = ['approved_by', 'user_id'];
    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
