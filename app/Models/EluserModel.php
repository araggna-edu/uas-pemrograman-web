<?php

namespace App\Models;

use CodeIgniter\Model;

class EluserModel extends Model
{

    protected $table      = 'eluser';
    protected $primaryKey = 'userid';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'useremail',
        'userpassword',
        'userfullname',
        'userrole',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive'
    ];

    protected $useTimestamps = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['userpassword'])) {
            $data['data']['userpassword'] = password_hash($data['data']['userpassword'], PASSWORD_BCRYPT);
        }

        return $data;
    }

}