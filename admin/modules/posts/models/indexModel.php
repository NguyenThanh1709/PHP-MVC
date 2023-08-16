<?php
function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function get_info_post($post_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`='$post_id'");
    return $result;
}

function get_list_post() {
    $result = db_fetch_array("SELECT * FROM `tbl_post`");
    return $result;
}

function get_post_page($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function count_all_post()
{
    $result = db_num_rows("SELECT * FROM `tbl_post`");
    if ($result > 0) {
        return $result;
    }
}

function update_status($data,$str_check){
    $check = db_update('`tbl_post`',$data,"`post_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}

function get_list_post_search_page($start,$num_per_page,$search){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `post_title` LIKE '%{$search}%' OR `category` LIKE '%{$search}%' LIMIT $start,$num_per_page");
    if(!empty($result)){
        return $result;
    };
}

function search_str($search){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `post_title` LIKE '%{$search}%' OR `category` LIKE '%{$search}%'");
    if(!empty($result)){
        return $result;
    }
}

function get_list_post_status($status){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `post_status` = '{$status}'");
    return $result;
}

function count_post_publish()
{
    $result = db_num_rows("SELECT * FROM `tbl_post` WHERE `post_status` = 'publish'");
    return $result;
}

function count_post_pending()
{
    $result = db_num_rows("SELECT * FROM `tbl_post` WHERE `post_status` = 'pending'");
    return $result;
}

function count_post_trash()
{
    $result = db_num_rows("SELECT * FROM `tbl_post` WHERE `post_status` = 'trash'");
    return $result;
}