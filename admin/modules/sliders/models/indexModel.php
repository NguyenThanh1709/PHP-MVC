<?php
function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function get_info_slider($slider_id) {
    $info_slider = db_fetch_row("SELECT * FROM `tbl_sliders` WHERE `slider_id` = '{$slider_id}'");
    return $info_slider;
}

function count_all_slider()
{
    $result = db_num_rows("SELECT * FROM `tbl_sliders`");
    if ($result > 0) {
        return $result;
    }
}

function update_status($data,$str_check){
    $check = db_update('`tbl_sliders`',$data,"`slider_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}

function search_str($search){
    $result = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `slider_name` LIKE '%{$search}%'");
    if(!empty($result)){
        return $result;
    }
}

function get_list_slider_search_page($start,$num_per_page,$search){
    $result = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `slider_name` LIKE '%{$search}%' LIMIT $start,$num_per_page");
    if(!empty($result)){
        return $result;
    };
}

function get_list_pages_status($status){
    $result = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `slider_status` = '{$status}'");
    return $result;
}

function get_sliders_page($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_sliders` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function get_list_sliders()
{
    $result = db_fetch_array("SELECT * FROM `tbl_sliders`");
    return $result;
}

function count_slider_publish()
{
    $result = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'publish'");
    return $result;
}

function count_slider_pending()
{
    $result = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'pending'");
    return $result;
}

function count_slider_trash()
{
    $result = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'trash'");
    return $result;
}
