<?php

namespace App\Controllers;

use App\Models\ElcommentModel;

class CommentController extends BaseController
{

    public function getCommentByCourse(): void
    {

        $model = new ElcommentModel();

        $courseId = $this->request->getGet('courseId');
        $offset = $this->request->getGet('offset');
        $limit = $this->request->getGet('limit');

        $data = $model->getCommentsByCourseIdLazyLoad($courseId, $offset, $limit);

        echo json_encode($data);

    }

    /**
     * @throws \ReflectionException
     */
    public function save()
    {
        $model = new ElcommentModel();

        $data = $this->request->getJSON(true);

        $data = [
            "courseid" => $data['courseId'],
            "commentcontent" => $data['comment'],
            "createddate" => date("Y-m-d H:i:s"),
            "createdby" => session()->get('userid'),
            "updateddate" => date("Y-m-d H:i:s"),
            "updatedby" => session()->get('userid'),
            "isactive" => true
        ];

        if ($model->insert($data)) {
            return $this->response
                ->setStatusCode(201)
                ->setBody(
                    json_encode(
                        [
                            "success" => true,
                            "message" => "Comment has been saved"
                        ]
                    )
                );
        } else {
            return $this->response
                ->setStatusCode(500)
                ->setBody(
                    json_encode(
                        [
                            "success" => false,
                            "message" => "Comment could not be saved"
                        ]
                    )
                );
        }
    }

}
