<?php

class Admin extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');

        if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header('location:'. URLROOT );
        }
    }
    public function index() {
        $allUsers = $this->userModel->getAllUsers();
        $data = [
            'users' => $allUsers
        ];

        $this->view('pages/admin/allusers', $data);
    }

    public function user($user_id=0) {
        if($user_id == 0){
            header('location:'.URLROOT . '/admin');
        }
        $history = $this->userModel->getLoginLogoutHistory($user_id);
        
        $data = [
            'history' => $history,
        ];

        $this->view('pages/admin/userHistory', $data);
    }
}