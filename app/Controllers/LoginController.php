<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class LoginController extends BaseController
{
    public function index()
    {
        echo view('auth/login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'fname' => $user['fname'],
            'lname' => $user['lname'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            'role' => $user['role'],
            'avatar' => $user['avatar']
        ];

        session()->set($data);
        return true;
    }

    public function login()
    {

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');


        $userModel = new User();


        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {

            $this->setUserSession($user);
    

         
            if ($user['role'] == "user") {  
                return redirect()->to('/users');
            } elseif ($user['role'] == "employee") {

                return redirect()->to('/users');
            }
        } else {
            // var_dump('error');
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
