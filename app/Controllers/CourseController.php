<?php

namespace App\Controllers;

use App\Models\ElapprovalModel;
use App\Models\ElassetsModel;
use App\Models\ElcoursesModel;

class CourseController extends BaseController
{

    public function index(): string
    {
        return view('course/course');
    }

    public function detail($id): string
    {
        $model = new ElcoursesModel();
        $course = $model->getElcoursesById($id);

        return view('course/course-detail', ['course' => $course]);
    }

    public function add(): string
    {
        return view('course/course-add');
    }

    public function edit($id)
    {
        $model = new ElcoursesModel();
        $assetModel = new ElassetsModel();

        $course = $model->getElcoursesById($id);
        $asset = $assetModel->getAssetsByCourseId($id);

        return view('course/course-edit', ['course' => $course, 'asset' => $asset]);
    }

    /**
     * @throws \ReflectionException
     */
    public function save()
    {
        $course = new ElcoursesModel();
        $approval = new ElapprovalModel();
        $asset = new ElassetsModel();
        $db = \Config\Database::connect();

        $db->transBegin();

        try {
            $data = [
                'coursetitle' => $this->request->getPost('coursetitle'),
                'coursecontent' => $this->request->getPost('coursecontent'),
                'createddate' => date('Y-m-d H:i:s'),
                'createdby' => session()->get('userid'),
                'updateddate' => date('Y-m-d H:i:s'),
                'updatedby' => session()->get('userid'),
                'isactive' => !((session()->get('userrole') != 'ADMIN')),
                'isapprove' => !((session()->get('userrole') != 'ADMIN'))
            ];

            $courseId = $course->insert($data);

            $dataApprove = [
                'courseid' => $courseId,
                'approvalreq' => session()->get('userid'),
                'createddate' => date('Y-m-d H:i:s'),
                'createdby' => session()->get('userid'),
                'updateddate' => date('Y-m-d H:i:s'),
                'updatedby' => session()->get('userid'),
                'isactive' => true
            ];

            $approval->insert($dataApprove);

            $files = $this->request->getFiles();

            $uploadPath = ROOTPATH . 'public/uploads/course-' . $courseId;

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($files) {
                foreach ($files['assets'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {

                        $newName = $file->getRandomName();

                        if ($file->move($uploadPath, $newName)) {
                            $filePath = 'uploads/course-' . $courseId . '/' . $newName;

                            $dataUpload = [
                                'courseid' => $courseId,
                                'assetfile' => $newName,
                                'assettype' => $file->getClientMimeType(),
                                'assetpath' => $filePath,
                                'createdby' => session()->get('userid'),
                                'updateddate' => date('Y-m-d H:i:s'),
                                'updatedby' => session()->get('userid'),
                                'isactive' => true
                            ];

                            $asset->insert($dataUpload);
                        } else {
                            return $this->response
                                ->setStatusCode(403)
                                ->setBody(
                                    json_encode(
                                        [
                                            "success" => false,
                                            "message" => "Upload failed! Internal Server Error"
                                        ]
                                    )
                                );
                        }
                    }
                }
            } else {
                return $this->response
                    ->setStatusCode(403)
                    ->setBody(
                        json_encode(
                            [
                                "success" => false,
                                "message" => "Upload failed! Files not valid"
                            ]
                        )
                    );
            }

            $db->transCommit();
            return $this->response
                        ->setStatusCode(201)
                        ->setBody(
                            json_encode([
                                "success" => true,
                                "message" => "Course added successfully!"
                            ])
                        );

        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(500)
                ->setBody(
                    json_encode([
                        "success" => false,
                        "message" => "Save Course Failed, Internal Server Error ".$e->getMessage()
                    ])
                );
        }
    }

    public function update()
    {
        $course = new ElcoursesModel();

        try {
            $data = [
                'coursetitle' => $this->request->getPost('coursetitle'),
                'coursecontent' => $this->request->getPost('coursecontent'),
                'updateddate' => date('Y-m-d H:i:s'),
                'updatedby' => session()->get('userid')
            ];

            $course->update($this->request->getPost('courseid'), $data);

            return $this->response
                        ->setStatusCode("200")
                        ->setBody(
                            json_encode([
                                "success" => true,
                                "message" => "Course updated successfully!"
                            ])
                        );
        } catch (\Exception $e) {
            return $this->response
                        ->setStatusCode("500")
                        ->setBody(
                            json_encode([
                                "success" => false,
                                "message" => "Save Course Failed, Internal Server Error ".$e->getMessage()
                            ])
                        );
        }
    }

    public function getActiveCourses()
    {
        $model = new ElcoursesModel();
        $modelAssets = new ElassetsModel();

        $offset = $this->request->getGet('offset');
        $limit = $this->request->getGet('limit');

        $data = $model->getElcoursesLazyLoad($limit, $offset);

        foreach ($data as $course) {
            $course->attachments = $modelAssets->getAssetsByCourseId($course->courseid);
        }

        return $this->response->setStatusCode(200)->setJSON($data);
    }

    public function getCourseByCreatedBy()
    {
        $model = new ElcoursesModel();
        $modelAssets = new ElassetsModel();
        $modelApproval = new ElapprovalModel();

        $offset = $this->request->getGet('offset');
        $limit = $this->request->getGet('limit');

        $data = $model->getElcoursesLazyLoadByCreatedBy(session()->get('userid'), $limit, $offset);

        foreach ($data as $course) {
            $course->attachments = $modelAssets->getAssetsByCourseId($course->courseid);
        }

        foreach ($data as $course) {
            $course->approval = $modelApproval->getApprovalByCourseId($course->courseid);
        }

        return $this->response->setStatusCode(200)->setJSON($data);
    }

}
