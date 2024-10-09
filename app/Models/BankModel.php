<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'bank';
    protected $allowedFields = ['kode', 'nama', 'url_logo', 'color', 'rate', 'mt940_file_name_format', 'mft_connect', 'created_by', 'created_at', 'updated_by', 'updated_at'];

    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
