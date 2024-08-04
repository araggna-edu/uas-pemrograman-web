<?php

namespace App\Models;

use CodeIgniter\Model;

class ElapprovalModel extends Model
{
    protected $table = 'elcourseapproval';
    protected $primaryKey = 'approvalid';

    protected $allowedFields = [
        'approvalid',
        'courseid',
        'approvalreq',
        'approvalby',
        'isapprove',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive'
    ];

    public function getApprovalByCourseId($id)
    {
        $builder = $this->db->table('elcourseapproval app')
                            ->select('app.approvalid,
                                            app.approvalby,
                                            app.isapprove,
                                            app.createddate,
                                            app.createdby,
                                            app.updateddate,
                                            app.updatedby')
                            ->join('elcourses cour', 'app.courseid = cour.courseid')
                            ->where('app.courseid', $id);

        return $builder->get()->getFirstRow();
    }
}
