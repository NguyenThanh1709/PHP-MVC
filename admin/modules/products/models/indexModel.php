<?php
function get_list_product_cat()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    if (count($result) > 0) {
        return $result;
    }
}

function get_cat_name_product($id)
{
    $result = db_fetch_row("SELECT `fullname` FROM `tbl_product_cat` WHERE `cat_id`='$id'");
    return $result;
}

function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}

function get_list_product()
{
    $result = db_fetch_array("SELECT * FROM `tbl_products`");
    return $result;
}

function get_products_page($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function count_all_product()
{
    $result = db_num_rows("SELECT * FROM `tbl_products`");
    if ($result > 0) {
        return $result;
    }
}

function count_product_publish()
{
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'publish'");
    return $result;
}

function count_product_pending()
{
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'pending'");
    return $result;
}

function count_product_trash()
{
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'trash'");
    return $result;
}

function get_list_pages_status($status){
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = '{$status}'");
    return $result;
}

function get_list_product_search_page($start,$num_per_page,$search){
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%{$search}%' LIMIT $start,$num_per_page");
    if(!empty($result)){
        return $result;
    };
}

function search_str($search){
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%{$search}%' ");
    if(!empty($result)){
        return $result;
    }
}

function update_status($data,$str_check){
    $check = db_update('`tbl_products`',$data,"`product_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}

function get_product_by_id ($product_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}
