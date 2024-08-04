<?php

namespace App\Models;

use CodeIgniter\Model;

class ElcommentModel extends Model
{
    protected $table = 'elcoursecomment';
    protected $primaryKey = 'commentid';

    protected $allowedFields = [
        'commentid',
        'courseid',
        'commentcontent',
        'createddate',
        'createdby',
        'updateddate',
        'updatedby',
        'isactive'
    ];

    public function getCommentsByCourseIdLazyLoad($courseid, $limit, $offset) {
        $builder = $this->db->table($this->table)
                            ->select('elcoursecomment.commentid,
                                            elcoursecomment.commentcontent,
                                            elcoursecomment.createddate,
                                            eluser.userfullname')
                            ->join('elcourses', 'elcoursecomment.courseid = elcourses.courseid')
                            ->join('eluser', 'elcoursecomment.createdby = eluser.userid')
                            ->where('elcoursecomment.isactive', true)
                            ->where('elcoursecomment.courseid', $courseid)
                            ->orderBy('elcoursecomment.createddate', 'DESC')
                            ->limit($limit, $offset);

        return $builder->get()->getResult();
    }


}
