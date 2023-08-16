<?php
function get_name_cat($cat_id)
{
    $result = db_fetch_row("SELECT `cat_name` FROM `tbl_product_cat` WHERE `cat_id`= '$cat_id'");
    if ($result > 0) {
        return $result;
    }
}
function get_product_cats($list_id)
{
    
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `cat_id` IN ($list_id)");
    if ($result > 0) {
        return $result;
    }
}
function get_product_arrange_cats($min="", $max="", $list_id)
{
    if (empty($max) && !empty($min)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` <= '$min' AND `product_status` = 'publish' AND `cat_id` IN ($list_id)");
    } else if (empty($min) && !empty($max)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` >= '$max' AND `product_status` = 'publish' AND `cat_id` IN ($list_id)");
    } else {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` >= '$min' AND `product_price` <= '$max' AND `product_status` = 'publish' AND `cat_id` IN ($list_id)");
    }
    // $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `cat_id` IN ($list_id)");
    if ($result > 0) {
        return $result;
    }
}
function get_list_product_cat()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    if (count($result) > 0) {
        return $result;
    }
}
function get_product_by_id($product_id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}

function get_product_by_id_cart($product_id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}

function get_list_product_top()
{
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' ORDER BY `num_add_cart` DESC LIMIT 0,6");
    return $list_product_top;
}

function get_cat_parent_product()
{
    $list_cat_parent = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $list_cat_parent;
}

function get_product_by_cat($cat_id)
{
    $listProductCat = db_fetch_array("SELECT * FROM `tbl_products` WHERE `cat_id`= '$cat_id'");
    return $listProductCat;
}

function get_list_product()
{
    $result = db_fetch_array("SELECT * FROM `tbl_products`");
    return $result;
}

function get_list_product_selling()
{
    $list_product_top = db_fetch_array("SELECT * FROM `tbl_products`  WHERE `product_status` = 'publish' ORDER BY `num_check_out` DESC LIMIT 0,6");
    return $list_product_top;
}

function get_product_page($start, $num_per_page, $where = "")
{
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT $start,$num_per_page");
    return $result;
}

function get_list_search($key)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%{$key}%' AND `product_status` = 'publish'");
    return $result;
}

function get_product_filters($min = "", $max = "")
{
    if (empty($max) && !empty($min)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` <= '$min' AND `product_status` = 'publish'");
    } else if (empty($min) && !empty($max)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` >= '$max' AND `product_status` = 'publish'");
    } else {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` >= '$min' AND `product_price` <= '$max' AND `product_status` = 'publish'");
    }
    return $result;
}

function get_product_filters_pages($min = "", $max = "", $start, $num_per_page)
{
    if (empty($max) && !empty($min)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` <= '$min' AND `product_status` = 'publish' ORDER BY `product_price` ASC LIMIT $start,$num_per_page ");
    } else if (empty($min) && !empty($max)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` >= '$max' AND `product_status` = 'publish' ORDER BY `product_price` ASC LIMIT $start,$num_per_page ");
    } else {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_price` >= '$min' AND `product_price` <= '$max' AND `product_status` = 'publish' ORDER BY `product_price` ASC LIMIT $start,$num_per_page ");
    }
    return $result;
}

function get_product_arrange($arrange_name = "", $arrange_price = "")
{
    if (!empty($arrange_name)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'publish' ORDER BY `product_name` $arrange_name");
    } else {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'publish' ORDER BY `product_price` $arrange_price");
    }
    return $result;
}

function get_product_arrange_page($arrange_name = "", $arrange_price = "", $start, $num_per_page)
{
    if (!empty($arrange_name)) {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'publish' ORDER BY `product_name` $arrange_name LIMIT $start,$num_per_page");
    } else {
        $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'publish' ORDER BY `product_price` $arrange_price LIMIT $start,$num_per_page");
    }
    return $result;
}
