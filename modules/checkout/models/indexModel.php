<?php
function get_name($column, $table, $where) {
    $result = db_fetch_row("SELECT $column FROM $table WHERE $where");
    return $result;
}

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_product_by_id($product_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function get_list_province_city () {
    $result = db_fetch_array("SELECT * FROM `tbl_province_city`");
    return $result;
}

function get_list_district_by_id ($idProvinceCity) {
    $result = db_fetch_array("SELECT * FROM `tbl_district` WHERE `matp` = '$idProvinceCity'");
    return $result;
}

function get_list_commune_by_id ($idDisTrict) {
    $result = db_fetch_array("SELECT * FROM `tbl_commune` WHERE `maqh` = '$idDisTrict'");
    return $result;
}

function get_info_customer($id_order) {
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = '$id_order'");
    return $result;
}

function get_info_product_order($id_order) {
    $result = db_fetch_array("SELECT * FROM `tbl_order_detail` WHERE `id_order` = '$id_order'");
    return $result;
}