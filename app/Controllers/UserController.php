<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;


class UserController extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Load the URL helper using Dependency Injection
        helper('url');
        $this->db = \Config\Database::connect();
        $this->response = service('response');
    }
    public function index()
    {
        helper('url');
        echo view('layouts/header');
        echo view('users/index');
        echo view('layouts/footer');
    }

    public function fetchAll()
    {
        $User = new User();
        $data = $User->findAll();
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $User = new User();
        $pW = $this->request->getVar('password');
        $hashedPass = password_hash($pW, PASSWORD_BCRYPT);
        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'username' => $this->request->getVar('fname'),
            'email' => $this->request->getVar('email'),
            'role' => 'user',
            'password' => $hashedPass,
        ];

  


        if ($User->insert($data)) {
            $responseData = [
                'message' => 'User created successfully',
                'data' => $data,
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON($responseData);
        } else {
            // Handle database insert failure
            return $this->response
                ->setStatusCode(500) // Internal Server Error
                ->setJSON(['error' => 'User creation failed.']);
        }
    }

    public function delete($id)
    {
        
     
        $User = new User();
        $User->delete($id);
        return json_encode(['message' => 'User deleted successfully']);
    }

    public function show($id)
    {
        $User = new User();
        $userInfo = $User->find($id);
 
        if ($userInfo) {
          
            return $this->response->setJSON($userInfo);
        } else {
            return $this->response->setJSON(['error' => 'User not found'])->setStatusCode(404);
        }
    }
    

    public function update($id)
    {
        $User = new User();
        $pW = $this->request->getVar('password');
        $hashedPass = password_hash($pW, PASSWORD_BCRYPT);

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'username' => $this->request->getVar('fname'),
            'email' => $this->request->getVar('email'),
            'role' => 'employee',
            'password' => $hashedPass,
        ];
        $User->update($id, $data);

        return $this->response->setJSON(['message' => 'User updated successfully']);
    }


}
