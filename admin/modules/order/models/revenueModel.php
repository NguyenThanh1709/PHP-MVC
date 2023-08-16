<?php
function get_revenue($month, $year)
{
    $result = db_fetch_array("SELECT DATE(`date_order`) as Ngay, SUM(`total_price`) as DoanhThu FROM `tbl_order` WHERE MONTH(`date_order`) = '$month' AND YEAR(`date_order`) = '$year' AND `status` = 'delivered' GROUP BY Ngay ORDER BY DoanhThu DESC");
    return $result;
}
function get_revenue_product($month, $year)
{
    $result = db_fetch_array("SELECT a.`name_product`, SUM(a.`quantity`) as SoLuong, SUM(a.`price`) as DoanhThu FROM `tbl_order_detail` as a, `tbl_order` as b WHERE a.`id_order` = b.`order_id` AND MONTH(b.`date_order`) = '$month' AND YEAR(b.`date_order`) = '$year' AND `status` = 'delivered' GROUP BY a.`name_product`");
    return $result;
}
function get_product_buy_month_paging($start, $num_per_page, $month, $year)
{
    $result = db_fetch_array("SELECT a.`name_product`, SUM(a.`quantity`) as SoLuong, SUM(a.`price`) as DoanhThu FROM `tbl_order_detail` as a, `tbl_order` as b WHERE a.`id_order` = b.`order_id` AND MONTH(b.`date_order`) = '$month' AND YEAR(b.`date_order`) = '$year' AND `status` = 'delivered' GROUP BY a.`name_product` LIMIT $start, $num_per_page");
    return $result;
}
function get_list_product_buy_day($day, $month, $year)
{
    $result = db_fetch_array("SELECT a.`name_product`, SUM(a.`quantity`) as SoLuong, SUM(a.`price`) as DoanhThu FROM `tbl_order_detail` as a, `tbl_order` as b WHERE a.`id_order` = b.`order_id` AND DAY(b.`date_order`) = '$day' AND MONTH(b.`date_order`) = '$month' AND YEAR(b.`date_order`) = '$year' AND `status` = 'delivered' GROUP BY a.`name_product`");
    if ($result > 0) {
        return $result;
    }
}
function get_list_product_buy_day_paging($start, $num_per_page, $day, $month, $year)
{
    $result = db_fetch_array("SELECT a.`name_product`, SUM(a.`quantity`) as SoLuong, SUM(a.`price`) as DoanhThu FROM `tbl_order_detail` as a, `tbl_order` as b WHERE a.`id_order` = b.`order_id` AND DAY(b.`date_order`) = '$day' AND MONTH(b.`date_order`) = '$month' AND YEAR(b.`date_order`) = '$year' AND `status` = 'delivered' GROUP BY a.`name_product` LIMIT $start, $num_per_page");
    if ($result > 0) {
        return $result;
    }
}
function get_list_day_data () {
    $result = db_fetch_array("SELECT DISTINCT MONTH(`date_order`) as month FROM `tbl_order`");
    return $result;
}

function get_list_year_data () {
    $result = db_fetch_array("SELECT DISTINCT YEAR(`date_order`) as year FROM `tbl_order`");
    return $result;
}

function get_info_user($username)
{
    $info_user_login = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $info_user_login;
}