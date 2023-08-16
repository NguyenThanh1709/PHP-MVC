<?php
function get_list_product_cat()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $result;
}

function get_list_product_cat_lv_0()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = 0");
    if (count($result) > 0) {
        return $result;
    }
}

function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function get_total()
{
    $result = db_num_rows("SELECT * FROM `tbl_product_cat`");
    return $result;
}

function get_info_dir($cat_id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = '$cat_id'");
    return $result;
}

function get_dir_product_page($start, $num_per_page, $parent_id){   
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = $parent_id LIMIT $start, $num_per_page");
    return $result;
}




