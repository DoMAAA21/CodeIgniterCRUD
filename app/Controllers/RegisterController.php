<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;


class RegisterController extends BaseController
{
    public function index()
    {
        echo view('auth/register');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'fname' => $user['fname'],
            'lname' => $user['lname'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            "role" => $user['role'],
        ];

        session()->set($data);
        return true;
    }

    public function register()
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


            $usercreds = $User->where('email', $data['email'])->first();
            $this->setUserSession($usercreds);

            return redirect()->to('/users');
        } else {
            return redirect()->to('/register')->with('error', 'Registration Failed');
        }
    }
}
