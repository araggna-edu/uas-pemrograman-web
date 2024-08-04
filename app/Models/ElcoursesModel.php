<?php

namespace App\Models;

use CodeIgniter\Model;

class ElcoursesModel extends Model
{
    protected $table = 'elcourses';
    protected $primaryKey = 'courseid';

    protected $allowedFields = [
        'courseid',
        'coursetitle',
        'coursecontent',
        'isapprove',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive'
    ];

    public function getAll()
    {
        $builder = $this->db->table('elcourses')
                            ->select('*');

        return $builder->get()->getResult();
    }

    public function getElcoursesLazyLoad($limit, $offset)
    {
        $builder = $this->db->table($this->table)
                            ->select('elcourses.courseid,
                                            elcourses.coursetitle,
                                            elcourses.coursecontent,
                                            eluser.userfullname,
                                            elcourses.createddate')
                            ->join('eluser', 'elcourses.createdby = eluser.userid')
                            ->where('elcourses.isactive', true)
                            ->orderBy('elcourses.createddate', 'DESC')
                            ->limit($limit, $offset);

        return $builder->get()->getResult();
    }

    public function getElcoursesLazyLoadByCreatedBy($createdBy, $limit, $offset)
    {
        $builder = $this->db->table($this->table)
            ->select('elcourses.courseid,
                                            elcourses.coursetitle,
                                            elcourses.coursecontent,
                                            eluser.userfullname,
                                            elcourses.createddate,
                                            elcourses.isapprove')
            ->join('eluser', 'elcourses.createdby = eluser.userid')
            ->where('elcourses.createdby', $createdBy)
            ->orderBy('elcourses.createddate', 'DESC')
            ->limit($limit, $offset);

        return $builder->get()->getResult();
    }

    public function getElcoursesById($id)
    {
        $builder = $this->db->table($this->table)
            ->select('elcourses.courseid,
                            elcourses.coursetitle,
                            elcourses.coursecontent,
                            eluser.userfullname,
                            elcourses.createddate')
            ->join('eluser', 'elcourses.createdby = eluser.userid')
            ->where('elcourses.courseid', $id)
            ->orderBy('elcourses.createddate', 'DESC');

        return $builder->get()->getFirstRow();
    }
}
