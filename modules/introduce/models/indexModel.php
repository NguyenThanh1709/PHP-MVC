<?php
function get_info_pages_introdue() {
    $result = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_name` = 'Giới thiệu'");
    return $result;
}

function get_list_product_selling() {
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' ORDER BY `num_check_out` DESC LIMIT 0,6");
    return $list_product_top;
}