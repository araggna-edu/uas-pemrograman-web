<?php
namespace App\Controllers;

use App\Models\ElcoursesModel;

class DashboardController extends BaseController
{

    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = new ElcoursesModel();
    }

    public function index()
    {
        return view('admin/dashboard/index');
    }


}
