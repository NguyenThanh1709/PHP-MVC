<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $list_cart = get_list_buy_cart();
    $data = array(
        'list_cart' => $list_cart
    );
    load_view('index', $data);
}

function add_cartAction()
{
    global $num;
    function add_cart()
    {
        if (isset($_POST['id'])) {
            $product_id = $_POST['id'];
            $get_product_by_id = get_product_by_id($product_id);
            if ($get_product_by_id['sale_off'] > 0) {
                $productPrice = $get_product_by_id['sale_off'];
            } else if ($get_product_by_id['sale_off'] == 0) {
                $productPrice = $get_product_by_id['product_price'];
            }
            // Thêm thông tin vào giỏ hàng
            $qty = $_POST['qty'];
            if (isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
                $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + 1;
            }
            $_SESSION['cart']['buy'][$product_id] = array(
                'id' => $get_product_by_id['product_id'],
                'product_title' => $get_product_by_id['product_name'],
                'price' => $productPrice,
                'product_img' => explode(',', $get_product_by_id['url_images'])[0],
                // 'code' => $get_product_by_id['product_code'],
                'qty' => $qty,
                'sub_total' => $productPrice * $qty
            );
            update_info_cart();
        }
    }
    add_cart();
    get_num_order_cart();
    get_list_buy_cart();
    $num = get_num_order_cart();
    $data = array(
        'total_price_cart' => currency_format(get_total_cart()),
        'num' => $num,
        'listCart' => get_list_buy_cart(),
    );
    echo json_encode($data);
}

function delete_cartAction()
{
    $id = $_POST['id'];
    $delete_cart = delete_cart($id);
    if ($delete_cart) {
        echo 1;
    } else {
        echo 0;
    }
}

function delete_cart_allAction()
{
    unset($_SESSION['cart']);
    echo 1;
}

function updateAjaxAction()
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $get_product_by_id = get_product_by_id($id);
    if ($get_product_by_id['sale_off'] > 0) {
        $productPrice = $get_product_by_id['sale_off'];
    } else if ($get_product_by_id['sale_off'] == 0) {
        $productPrice = $get_product_by_id['product_price'];
    }

    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        //Cập nhật số lượng
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;

        //Cập nhật tổng tiền
        $sub_total = $qty * $productPrice;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

        //Gọi hàm update cart
        update_info_cart();

        //Gán số lượng đã thêm vào giỏ hàng = biến num
        $num = get_num_order_cart();

        //Lấy thông tin trong giỏ hàng
        $total = get_total_cart();

        //Nhận giá trị trả về
        $data = array(
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($total),
            'num' => $num,
            'id' => $id
        );
        echo json_encode($data);
    }
}
