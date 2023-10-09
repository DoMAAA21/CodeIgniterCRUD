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

    public function login()
    {
        // return redirect()->to('/users');
        // var_dump('error');
        // Get the input data from the form
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // var_dump($password);
        // Load the UserModel (replace with your actual model)
        $userModel = new User();

        // Check if a user with the provided username exists
        $user = $userModel->where('email', $email)->first();

       

        // var_dump($us);

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct
            // You can store user data in session or implement JWT authentication
            // For example, store user ID in session:
            session()->set('user_id', $user['id']);

            // Redirect to a dashboard or protected page
            return redirect()->to('/users');
        } else {
            // Authentication failed
            var_dump('error');
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }
}
