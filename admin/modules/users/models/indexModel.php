<?php
function update_password($data, $reset_token){
    db_update('tbl_users', $data, "`reset` = '{$reset_token}'");
}

function check_reset_token($reset_token) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset` = '{$reset_token}'");
    if ($check > 0) {
        return true;
    }
    return false;
}

//Check email đã tồn tại trong hệ thống hay chưa
function check_email($email){
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    if ($check > 0) {
        return true;
    }
    return false;
}

function update_reset_token ($data, $email) {
    db_update('tbl_users', $data, "`email`='$email'");
}

function check_login($username, $password)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if ($check_user > 0) {
        return true;
    }
    return false;
}

//Lấy fullname user vừa đăng nhập
function get_fullname_login($username, $password)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    $fullname = $info_user_login['fullname'];
    return $fullname;
}

//Lấy thông tin của user vừa đăng nhập
function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function get_info_user_team($user_id)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = '{$user_id}'");
    return $info_user_login;
}



