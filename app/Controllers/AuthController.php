<?php

namespace App\Controllers;

use App\Models\EluserModel;

class AuthController extends BaseController
{

    protected $eluserModel;

    public function __construct() {
        $this->eluserModel = new EluserModel();
    }

    public function index()
    {
        return view('auth');
    }

    public function register()
    {
        $data = [
            'useremail' => $this->request->getPost('useremail'),
            'userpassword' => $this->request->getPost('userpassword'),
            'userfullname' => $this->request->getPost('userfullname'),
            'userrole' => 'USER',
            'createddate' => date('Y-m-d H:i:s'),
            'createdby' => 0, // Will be updated later with userid
            'updateddate' => date('Y-m-d H:i:s'),
            'updatedby' => 0, // Will be updated later with userid
            'isactive' => true,
        ];

        if ($this->eluserModel->insert($data)) {
            $insertID = $this->eluserModel->getInsertID();
            $this->eluserModel->update($insertID, ['createdby' => $insertID, 'updatedby' => $insertID]);
            return redirect()->to('/auth')->with('registerSuccess', 'Registration successful. You can now log in.');
        } else {
            return redirect()->to('/auth')->with('registerError', 'Registration failed. Please try again.');
        }
    }

    public function login()
    {
        $email = $this->request->getPost('useremail');
        $password = $this->request->getPost('userpassword');

        $user = $this->eluserModel->where('useremail', $email)->first();

        if ($user && password_verify($password, $user['userpassword']) && $user['isactive']) {
            // Store user info in session
            session()->set([
                'userid' => $user['userid'],
                'useremail' => $user['useremail'],
                'userfullname' => $user['userfullname'],
                'userrole' => $user['userrole'],
                'logged_in' => true,
            ]);
            return redirect()->to('/');
        } else {
            return redirect()->to('/auth')->with('loginError', 'Login failed. Please check your credentials and make sure your account is active.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }

}
