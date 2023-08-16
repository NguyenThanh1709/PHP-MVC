<?php
function get_info_banner($banner_id) {
    $info_banner = db_fetch_row("SELECT * FROM `tbl_banners` WHERE `banner_id` = '{$banner_id}'");
    return $info_banner;
}
function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function count_all_banner()
{
    $result = db_num_rows("SELECT * FROM `tbl_banners`");
    if ($result > 0) {
        return $result;
    }
}

function update_status($data,$str_check){
    $check = db_update('`tbl_banners`',$data,"`banner_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}

function search_str($search){
    $result = db_fetch_array("SELECT * FROM `tbl_banners` WHERE `banner_name` LIKE '%{$search}%'");
    if(!empty($result)){
        return $result;
    }
}

function count_banner_publish()
{
    $result = db_num_rows("SELECT * FROM `tbl_banners` WHERE `status` = 'publish'");
    return $result;
}

function count_banner_pending()
{
    $result = db_num_rows("SELECT * FROM `tbl_banners` WHERE `status` = 'pending'");
    return $result;
}

function count_banner_trash()
{
    $result = db_num_rows("SELECT * FROM `tbl_banners` WHERE `status` = 'trash'");
    return $result;
}

function get_list_banners() {
    $result = db_fetch_array("SELECT * FROM `tbl_banners`");
    return $result;
}

function get_banners_pages($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_banners` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function get_list_banners_status($status) {
    $result = db_fetch_array("SELECT * FROM `tbl_banners` WHERE `status` = '{$status}'");
    return $result;
}

function get_list_banner_search_page($start, $num_per_page, $search){
    $result = db_fetch_array("SELECT * FROM `tbl_banners` WHERE `banner_name` LIKE '%{$search}%' LIMIT $start,$num_per_page");
    if(!empty($result)){
        return $result;
    };
}
