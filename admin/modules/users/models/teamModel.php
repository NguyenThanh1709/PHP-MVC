<?php
//Lấy danh sách nhóm quản trọ
function update_status($data,$str_check){
    $check = db_update('`tbl_users`',$data,"`user_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}
function get_list_team()
{
    $list_team = db_fetch_array("SELECT * FROM `tbl_users`");
    return $list_team;
}

function count_system_admin()
{
    $count = db_num_rows("SELECT * FROM `tbl_users` WHERE `permission` = 'all'");
    return $count;
}

function count_post_admin()
{
    $count = db_num_rows("SELECT * FROM `tbl_users` WHERE `permission` = 'post'");
    return $count;
}

function count_page_admin()
{
    $count = db_num_rows("SELECT * FROM `tbl_users` WHERE `permission` = 'page'");
    return $count;
}

function get_team_page($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_users` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function get_list_post_search_page($start, $num_per_page, $search)
{
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `post_title` LIKE '%{$search}%' OR `category` LIKE '%{$search}%' LIMIT $start,$num_per_page");
    if (!empty($result)) {
        return $result;
    };
}

function get_list_team_search_page($start, $num_per_page, $search)
{
    $result = db_fetch_array("SELECT * FROM `tbl_users` WHERE `fullname` LIKE '%{$search}%' LIMIT $start, $num_per_page");
    if (!empty($result)) {
        return $result;
    };
}

function get_list_pages_permission($status)
{
    $result = db_fetch_array("SELECT * FROM `tbl_users` WHERE `permission` = '{$status}'");
    return $result;
}

function search_str($search)
{
    $result = db_fetch_array("SELECT * FROM `tbl_users` WHERE `fullname` LIKE '%{$search}%' OR `username` LIKE '%{$search}%'");
    if (!empty($result)) {
        return $result;
    }
}
