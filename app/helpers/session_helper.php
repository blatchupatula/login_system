<?php
session_start();

function isLoggedIn() {
    if(isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function isLogout() {
    if(isset($_SESSION['isLogout'])) {
        return true;
    } else {
        return false;
    }
}
?>