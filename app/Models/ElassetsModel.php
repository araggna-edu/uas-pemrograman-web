<?php

namespace App\Models;

use CodeIgniter\Model;

class ElassetsModel extends Model
{
    protected $table = 'elcourseassets';
    protected $primaryKey = 'assetid';
    protected $allowedFields = [
        'assetid',
        'courseid',
        'assetfile',
        'assettype',
        'assetpath',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive'
    ];

    public function getAssetsByCourseId($courseid) {
        $builder = $this->db->table('elcourseassets assets')
                            ->select("assets.assetid,
                                            assets.assetfile,
                                            assets.assetpath,
                                            assets.assettype")
                            ->join('elcourses course', 'assets.courseid = course.courseid')
                            ->where('course.courseid', $courseid)
                            ->where('assets.isactive', true)
                            ->orderBy('assets.createddate', 'ASC');

        return $builder->get()->getResultArray();
    }
}
