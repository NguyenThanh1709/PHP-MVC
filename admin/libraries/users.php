<?php
function is_login()
{
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}

function fullname_user_login()
{
    if (isset($_SESSION['fullname'])) {
        echo $_SESSION['fullname'];
    }
    return false;
}

function get_fullname($id_user) {
    $result = db_fetch_row("SELECT `fullname` FROM `tbl_users` WHERE `user_id` = '$id_user'");
    return $result;
}

function get_name_dir($cat_id) {
    $result = db_fetch_row("SELECT `cat_name` FROM `tbl_product_cat` WHERE `cat_id` = '$cat_id'");
    return $result;
}
