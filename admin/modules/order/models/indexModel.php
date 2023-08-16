<?php
function sum_total_price_order_success()
{
    $total_price = db_fetch_row("SELECT SUM(`total_price`) as `total_price_order_success` FROM `tbl_order` WHERE `status` = 'delivered'");
    return $total_price;
}
function get_list_month ($month) {
    $result = db_fetch_array("SELECT DISTINCT MONTH(`date_order`) as month FROM `tbl_order`");
    return $result;
}

function get_list_years () {
    $result = db_fetch_array("SELECT DISTINCT YEAR(`date_order`) as year FROM `tbl_order`");
    return $result;
}

function get_list_order() {
    $result = db_fetch_array("SELECT * FROM `tbl_order` ORDER BY `date_order` DESC");
    return $result;
}

function get_list_order_year($year) {
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE YEAR(`date_order`) = '$year'");
    return $result;
}

function get_order_paging($start, $num_per_page, $status = "")
{
    if(!empty($status)){
        $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status`='$status' ORDER BY `date_order` DESC LIMIT $start, $num_per_page");
    }else {
        $result = db_fetch_array("SELECT * FROM `tbl_order` ORDER BY `date_order` DESC LIMIT $start, $num_per_page");
    }   
    return $result;
}

function get_status_order($status)
{
    $list_order_new = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status`='$status'");
    return $list_order_new;
}
function update_status($data,$str_check){
    $check = db_update('`tbl_order`',$data,"`order_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}
function count_delivering_order()
{
    $list_order_month = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='delivering'");
    return $list_order_month;
}
function count_delivered_order()
{
    $list_order_month = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='delivered'");
    return $list_order_month;
}
function count_canceled_order()
{
    $list_order_month = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='canceled'");
    return $list_order_month;
}
function count_processing_order()
{
    $list_order_month = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='processing'");
    return $list_order_month;
}
function count_all_order()
{
    $number_order_month = db_num_rows("SELECT * FROM `tbl_order`");
    return $number_order_month;
}
function search_str($search){
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `fullname` LIKE '%{$search}%' OR `phone` = '$search'");
    if(!empty($result)){
        return $result;
    }
}
function get_list_name_search_order($start,$num_per_page,$search){
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `fullname` LIKE '%{$search}%' OR `phone` = '$search' LIMIT $start,$num_per_page");
    if(!empty($result)){
        return $result;
    };
}
function get_info_order_by_id($id_order) {
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = '$id_order'");
    return $result;
}
function get_list_product_order_by_id($id) {
    $list_product_order_by_id_new = db_fetch_array("SELECT * FROM `tbl_order_detail` WHERE `id_order`='$id'");
    return $list_product_order_by_id_new;
}
function get_name_district($id_district) {
    $name_district = db_fetch_row("SELECT `name` FROM `tbl_district` WHERE `maqh`='$id_district'");
    return $name_district;
}
function get_name_commune($idxa) {
    $name_commune = db_fetch_row("SELECT `name` FROM `tbl_commune` WHERE `xaid` = '$idxa'");
    return $name_commune;
}
function get_name_province_city($id_province_city) {
    $name_province_city = db_fetch_row("SELECT `name` FROM `tbl_province_city` WHERE `matp`='$id_province_city'");
    return $name_province_city;
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
function check_info_customer($numPhone)
{
    $result = db_fetch_row("SELECT DISTINCT * FROM `tbl_order` WHERE `phone` = '$numPhone'");
    return $result;
}
function get_list_product()
{
    $result = db_fetch_array("SELECT * FROM `tbl_products`");
    return $result;
}
function get_product_by_id ($product_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}
function get_list_search($searchName) {
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%$searchName%'");
    return $result;
}

