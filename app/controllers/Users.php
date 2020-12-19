<?php

class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    public function index() {
        if(!isset($_SESSION['user_id'])) {
            header('location:' . URLROOT );
        }
        $data = [];
        if($this->userModel->checkIsUserLogout($_SESSION['user_id'])) {
            $_SESSION['isLogout'] = 'no';
        }
        $this->view('pages/users', $data);
    }
}