<?php
function get_list_order_new($today)
{
    $list_order_new = db_fetch_array("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today'");
    return $list_order_new;
}
function count_all_new_order($today)
{
    $number_order_today = db_num_rows("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today'");
    return $number_order_today;
}
function count_processing_new_order($today)
{
    $list_order_new = db_num_rows("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `status`='processing'");
    return $list_order_new;
}
function get_status_new_order($today, $status)
{
    $list_order_new = db_fetch_array("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `status`='$status'");
    return $list_order_new;
}
function count_delivering_new_order($today)
{
    $list_order_new = db_num_rows("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `status`='delivering'");
    return $list_order_new;
}
function count_delivered_new_order($today)
{
    $list_order_new = db_num_rows("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `status`='delivered'");
    return $list_order_new;
}
function count_canceled_new_order($today)
{
    $list_order_new = db_num_rows("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `status`='canceled'");
    return $list_order_new;
}
function get_order_new_paging($start, $num_per_page, $today, $status = "")
{
    if(!empty($status)){
        $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `status`='$status' LIMIT $start, $num_per_page");
    }else {
        $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' LIMIT $start, $num_per_page");
    }   
    return $result;
}
function update_status($data,$str_check){
    $check = db_update('`tbl_order`',$data,"`order_id` IN ({$str_check})");
    if($check){
        return true;
    }
    return false;
}
function count_order_success()
{
    $list_order_success = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='delivered'");
    return $list_order_success;
}
function count_order_cenceled()
{
    $list_order_cenceled = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='canceled'");
    return $list_order_cenceled;
}
function count_order_processing()
{
    $list_order_processing = db_num_rows("SELECT * FROM `tbl_order` WHERE `status`='processing'");
    return $list_order_processing;
}
function sum_total_price_order_success()
{
    $total_price = db_fetch_row("SELECT SUM(`total_price`) as `total_price_order_success` FROM `tbl_order` WHERE `status` = 'delivered'");
    return $total_price;
}
function get_order_by_id($id, $today) {
    $info_order = db_fetch_row("SELECT * FROM `tbl_order` WHERE DATE(`date_order`) = '$today' AND `order_id`='$id'");
    return $info_order;
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


