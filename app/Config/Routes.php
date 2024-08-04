<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/auth', 'AuthController::index');
$routes->post('/register', 'AuthController::register');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/course', 'CourseController::index');
$routes->get('/course/(:num)', 'CourseController::detail/$1');
$routes->get('/course/add', 'CourseController::add');
$routes->get('/course/edit/(:num)', 'CourseController::edit/$1');

$routes->get('/admin/dashboard', 'DashboardController::index');
$routes->get('/admin/course', 'CourseAdminController::index');

$routes->get('/api/course/all', 'CourseController::getActiveCourses');
$routes->get('/api/course/my-course', 'CourseController::getCourseByCreatedBy');
$routes->post('/api/course/save', 'CourseController::save');
$routes->post('/api/course/update', 'CourseController::update');
$routes->get('/api/comment/all', 'CommentController::getCommentByCourse');
$routes->post('/api/comment/save', 'CommentController::save');

$routes->get('/api/admin/course/all', 'CourseAdminController::getAllCourses');
$routes->get('/api/admin/course/approve', 'CourseAdminController::approvalProcess');
$routes->get('/api/admin/course/delete', 'CourseAdminController::deleteProcess');
