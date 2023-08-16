<?php
//Lấy thông tin của user vừa đăng nhập
function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function get_list_pages()
{
    $get_list_pages = db_fetch_array("SELECT * FROM `tbl_pages`");
    return $get_list_pages;
}

function get_status_all(){
    $result = db_num_rows("SELECT * FROM `tbl_pages`");
    return $result;
}

function get_status_publish(){ 
    $result = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_status` = 'publish'");
    return $result;
}

function get_status_pending(){ 
    $result = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_status` = 'pending'");
    return $result;
}

function get_status_trash(){ 
    $result = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_status` = 'trash'");
    return $result;
}

function get_pages_page($start,$num_per_page,$where = ""){   
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_pages` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function get_list_pages_status($status){
    $result = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `page_status` = '{$status}'");
    return $result;
}

function get_list_search_page($start,$num_per_page,$search){
    $result = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `page_name` LIKE '%{$search}%' OR `page_title` LIKE '%{$search}%' LIMIT $start,$num_per_page");
    if(!empty($result)){
        return $result;
    };
}

function search_str($search){
    $result = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `page_name` LIKE '%{$search}%' OR `page_title` LIKE '%{$search}%'");
    if(!empty($result)){
        return $result;
    }
}

function update_status($data,$str_check){
    $check = db_update('`tbl_pages`',$data,"`page_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}

function get_info_page($page_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_id` = '{$page_id}'");
    return $result;
}

