<?php

namespace App\Controllers;

class CourseController extends BaseController
{

    public function index(): string
    {
        return view('course/course');
    }

}