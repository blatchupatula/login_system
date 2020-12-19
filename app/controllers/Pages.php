<?php

class Pages extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');

        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
            header('location:' . URLROOT . '/admin');
        }

        if(isset($_SESSION['user_id']) && $_SESSION['is_admin'] != 1){
            header('location:' . URLROOT . '/users');
        }
    }

    public function index() {
        $data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            if(empty($data['email'])) {
                $data['emailError'] = 'Enter email';
            }

            if(empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password';
            }

            if(empty($data['emailError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or Username is  incorrect. Please try again.';
                    $this->view('pages/index', $data);
                }
            }
        }

        $this->view('pages/index', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->user_email;
        $_SESSION['user_name'] = $user->user_name;
        $_SESSION['is_admin'] = $user->is_admin;

        if($_SESSION['is_admin'] == 1){
            header('location:' . URLROOT . '/admin');
        } else {
            header('location:' . URLROOT . '/users');
        }
    }

    public function logout() {

        if(isset($_SESSION['insert_id'])) {
            $this->userModel->update_logout_history($_SESSION['insert_id'], $_SESSION['user_id'] );

            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            unset($_SESSION['is_admin']);
            unset($_SESSION['insert_id']);
            unset($_SESSION['isLogout']);
        }
        header('location:' . URLROOT );
    }

    public function isLogout() {
        $this->userModel->update_is_logout($_SESSION['insert_id']);
    }
}