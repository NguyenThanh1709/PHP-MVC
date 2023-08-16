<?php
function get_list_blog() {
    $result = db_fetch_array("SELECT * FROM `tbl_post`");
    return $result;
}

function get_item_blog($post_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`='{$post_id}'");
    return $result;
}

function get_list_product_top() {
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' ORDER BY `num_add_cart` DESC LIMIT 0,6");
    return $list_product_top;
}

function get_post_page($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function get_list_product_selling() {
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' ORDER BY `num_check_out` DESC LIMIT 0,6");
    return $list_product_top;
}