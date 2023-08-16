<?php
function get_list_banners() {
    $result = db_fetch_array("SELECT * FROM `tbl_banners` WHERE `status`='publish'");
    return $result;
}
function get_list_prodouct_sale() {
    $listProductSale = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' AND `discount` > 0 LIMIT 0,8");
    return $listProductSale;
} 

function get_list_slider(){
    $listSlider = db_fetch_array("SELECT * FROM `tbl_sliders`  WHERE `slider_status` = 'publish' LIMIT 0,4");
    return $listSlider;
}

function get_list_laptop() {
    $listLapTop = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' AND `product_name` LIKE 'Laptop%' AND `discount` = 0 LIMIT 0,8");
    return $listLapTop;
}

function get_list_smart_phone () {
    $listsmartphoen = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' AND `product_name` LIKE 'Điện Thoại%' AND `discount` = 0 LIMIT 0,8");
    return $listsmartphoen;
}

function get_list_product_selling() {
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' ORDER BY `num_check_out` DESC LIMIT 0,6");
    return $list_product_top;
}

function get_list_product_top() {
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' AND `discount` = 0 ORDER BY `num_add_cart` DESC LIMIT 0,6");
    return $list_product_top;
}

function get_cat_parent_product(){
    $list_cat_parent = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $list_cat_parent;
}

function get_subcat_product($id_parent) {
    $listSubCat = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = '{$id_parent}'");
    return $listSubCat;
}

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}
