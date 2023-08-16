<?php
function get_product_by_id_cart($product_id) {
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}

function get_product_by_id($product_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'");
    return $result;
}

