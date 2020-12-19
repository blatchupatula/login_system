<?php

class User {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }

    public function login($email, $password) {
        $this->db->query("SELECT * FROM users WHERE user_email = :email AND user_password = :password");
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            $this->insert_login_history($row->user_id, $_SERVER['REMOTE_ADDR'] );
            return $row;
        } else {
            return false;
        }
    }

    public function insert_login_history($user_id, $ip_address) {
        $this->db->query("INSERT INTO login_logout_history (user_id, ip_address ) VALUES (:user_id, :ip_address)");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':ip_address', $ip_address);

        $lastInsertId = $this->db->lastId();

        if($lastInsertId) {
            $_SESSION['insert_id'] = $lastInsertId;
            return true;
        } else {
            return false;
        }
    }

    public function update_logout_history($insert_id, $user_id) {
        $this->db->query("UPDATE login_logout_history SET logout_time = :time WHERE id = :insert_id");
        $this->db->bind(':insert_id', $insert_id);

        date_default_timezone_set('Asia/Kolkata');
        $this->db->bind(':time', date('Y-m-d H:i:s'));

        $this->db->execute();
        return true;
    }

    public function getAllUsers() {
        $this->db->query("SELECT * FROM users WHERE is_admin != 1");
        $result = $this->db->resultSet();
        return $result;
    }

    public function getLoginLogoutHistory($user_id) {
        $this->db->query("SELECT llh.user_id, llh.login_time, llh.logout_time, llh.ip_address, u.user_name, u.user_email FROM login_logout_history llh
                            JOIN users u ON u.user_id = llh.user_id 
                            WHERE llh.user_id = :id ORDER BY llh.login_time DESC"
                        );
        $this->db->bind(':id', $user_id);
        $result = $this->db->resultSet();
        return $result;
    }

    public function update_is_logout($insert_id) {
        $this->db->query("UPDATE login_logout_history SET is_logout = 0 WHERE id = :insert_id AND ip_address = :ipaddress");
        $this->db->bind(':insert_id', $insert_id);
        $this->db->bind(':ipaddress', $_SERVER['REMOTE_ADDR']);
        $this->db->execute();
        return true;
    }

    public function checkIsUserLogout($user_id) {
        $this->db->query("SELECT * FROM login_logout_history WHERE logout_time is NULL AND user_id = :user_id AND is_logout=0");
        $this->db->bind(':user_id', $user_id);
        return $this->db->rowCount();
    }
}