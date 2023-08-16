<?php

function update_info_cart()
{
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }

        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total
        );
    }
}

function get_list_buy_cart()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?mod=user&act=delete_cart&id={$item['id']}";
        }
        return $_SESSION['cart']['buy'];
    }
    return false;
}

function get_num_order_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return false;
}

function get_total_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function delete_cart($id)
{
    //Xoá sản phẩm trong giỏ hàng
    if (isset($_SESSION)) {
        if (!empty($id)) {
            unset($_SESSION['cart']['buy'][$id]);
            update_info_cart();
        } else {
            unset($_SESSION['cart']);
        }
    }
}

function update_cart_number($qty) {
    foreach ($qty as $id => $new_qty){
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $new_qty *  $_SESSION['cart']['buy'][$id]['price'] ;
    }
    update_info_cart();
}
