<?php

namespace App\Models;

use CodeIgniter\Model;

class BisUnitModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'bis_unit';
    protected $allowedFields = ['kode', 'nama', 'list_rek_id'];
    // generate uuid before insert
    protected $beforeInsert = ['generateUuid'];

    protected function generateUuid(array $data)
    {
        $data['data']['id'] = guidv4();
        return $data;
    }
}
