<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class ProfileController extends BaseController
{
    public function index()
    {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            // Redirect to login page or display an error
            return redirect()->to('/login')->with('error', 'You must be logged in to view your profile.');
        }

      
        $userModel = new User();
        $email = session()->get('email');
        $user = $userModel->where('email', $email)->first();
        $data = [
            'firstName' => $user['fname'],
            'lastName' => $user['lname'],
            'email' => $user['email'],
            'role' => $user['role'],
            'avatar' => $user['avatar'], // Replace with the actual path to the user's avatar
        ];
        echo view('layouts/header');
        echo view('profile/index', $data);
    }


    public function upload()
{
    if (!session()->get('isLoggedIn')) {
        // Redirect to login page or display an error
        return redirect()->to('/login')->with('error', 'Error Occured Please re-login');
    }

    $uploadDirectory = WRITEPATH . 'uploads';

    $uploadedFile = $this->request->getFile('userfile');

    if ($uploadedFile->isValid()) {
        $newName = $uploadedFile->getRandomName();
        $uploadedFile->move($uploadDirectory, $newName);

        
        $userModel = new User();
        $userId = session()->get('id'); 
        $userModel->where('id',$userId)->set('avatar',$newName)->update();

        
        return redirect()->to('/me');
    } else {
       
        return redirect()->to('/me')->with('success', 'Avatar Changed');
    }
}

}
