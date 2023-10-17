<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $userModel = new \App\Models\UserModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUserID); 
        $data = [
            'title' =>'Admin',
            'userInfo' =>$userInfo
        ];

        return view('Admin/index', $data);
    }

    function profile(){
        $userModel = new \App\Models\UserModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUserID);
        $data = [
            'title' =>'Profile',
            'userInfo' =>$userInfo
        ];
        
        return view('Admin/profile', $data);

    }
}
