<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $error, $month, $search;
    $month = getdate();
    $year = $month['year'];
    $num_order = count_all_order();
    $num_order_processing = count_processing_order();
    $num_order_delivering = count_delivering_order();
    $num_order_delivered = count_delivered_order();
    $num_order_canceled = count_canceled_order();
    $total_price_order_success = sum_total_price_order_success();
    $listOrderMonth = get_list_order();
    $num_per_page = 25;
    $total_row = count($listOrderMonth);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_order_month_paging = get_order_paging($start, $num_per_page,);
    $base_url = "?mod=order";
    $status = "";
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_status_order = get_status_order($status);
        $total_row = count($list_status_order);
        $num_page = ceil($total_row / $num_per_page);
        $list_order_month_paging = get_order_paging($start, $num_per_page, $status);
        $base_url = "?mod=order&status=$status";
    }
    if (isset($_POST['btn_action'])) {
        $str_check = "";
        $error = array();
        if (empty($_POST['id_order'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['id_order']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'status' => $action,
            );
            update_status($data, $str_check);
            if (!isset($_GET['page'])) {
                redirect("?mod=order");
            } else if (isset($_GET['page'])) {
                redirect("?mod=order&page=$page_current");
            }
        }
    }

    if (isset($_POST['btn_search'])) {
        // show_array($_POST);
        if (empty($_POST['key'])) {
            $error['key'] = "Vui lòng nhập từ khoá tìm kiếm";
        } else {
            $search = $_POST['key'];
            $list_search = search_str($search);
            if ($list_search > 0) {
                $total_row = count($list_search);
                $num_page = ceil($total_row / $num_per_page);
                $list_order_month_paging = get_list_name_search_order($start, $num_per_page, $search);
                $base_url = "?mod=home&key={$search}";
            } else {
                $error['key'] = "Không tồn tại thông tin đơn hàng trong hệ thống";
            }
        }
    }
    $data = array(
        'list_order_month_paging' => $list_order_month_paging,
        'year' => $year,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'month' => $month,
        'page' => $page,
        'error' => $error,
        'status' => $status,
        'page_current' => $page_current,
        'num_order' => $num_order,
        'total_price_order_success' => $total_price_order_success,
        'num_order_processing' => $num_order_processing,
        'num_order_delivering' => $num_order_delivering,
        'num_order_delivered' => $num_order_delivered,
        'num_order_canceled' => $num_order_canceled,
    );
    load_view('index', $data);
}

function detailAction()
{
    if (isset($_GET['id_order'])) {
        $id_order = $_GET['id_order'];
        $infoIdOrder = get_info_order_by_id($id_order);
        $listProduct = get_list_product_order_by_id($id_order);
        $name_district = get_name_district($infoIdOrder['maqh']);
        $name_province_city = get_name_province_city($infoIdOrder['matp']);
        $name_commune =  get_name_commune($infoIdOrder['xaid']);
    }

    $data = array(
        'name_district' => $name_district,
        'name_province_city' => $name_province_city,
        'name_commune' => $name_commune,
        'infoIdOrder' => $infoIdOrder,
        'listProduct' => $listProduct
    );
    load_view('detail', $data);
}

function updateStatusAjaxAction()
{
    if (isset($_POST['statusOrder'])) {
        $status = $_POST['statusOrder'];
        $order_id = $_POST['order_id'];
        $data = array(
            'status' => $status
        );
        if (db_update('tbl_order', $data, "`order_id`= '$order_id'")) {
            echo json_encode("success");
        } else {
            echo json_encode("error");
        }
    }
}

function addAction()
{
    global $conn, $error;
    $today = date('Y/m/d  H:i:s');
    $total_price = currency_format(get_total_cart());
    $listProducts = get_list_product();
    $listProvinceCity = get_list_province_city();
    if (isset($_POST['btn_add'])) {
        // show_array($_POST);
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống tên khách hàng";
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống số điện thoại";
        } else if (!is_phone($_POST['phone'])) {
            $error['phone'] = "Số điện thoại không đúng";
        } else {
            $phone = $_POST['phone'];
        }
        if (empty($_POST['district'])) {
            $error['district'] = "Vui lòng chọn Quận/Huyện";
        } else {
            $district = $_POST['district'];
        }
        if (empty($_POST['commune'])) {
            $error['commune'] = "Vui lòng chọn Thị Trấn/Xã";
        } else {
            $commune = $_POST['commune'];
        }
        if (empty($_POST['province-city'])) {
            $error['province-city'] = "Vui lòng chọn Thành phố/Tỉnh";
        } else {
            $provinceCity = $_POST['province-city'];
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Vui lòng nhập địa chỉ";
        } else {
            $address = $_POST['address'];
        }
        if (empty($_POST['email'])) {
            $error['email'] = "Vui lòng nhập địa chỉ email";
        } else {
            $email = $_POST['email'];
        }
        if (empty($error)) {
            $name_province_city = get_name('name','tbl_province_city', "`matp`='$provinceCity'");
            $name_commune = get_name('name','tbl_commune', "`xaid`='$commune'");
            $name_district = get_name('name','tbl_district',"`maqh`='$district'");
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'date_order' => date('Y/m/d  H:i:s'),
                'payment_method' => 'payment_method',
                'status' => 'processing',
                'matp' => $provinceCity,
                'maqh' => $district,
                'xaid' => $commune,
                'total_price' => get_total_cart(),
            );
            $insertOrder = db_insert('tbl_order', $data);
            if ($insertOrder) {
                $id_order = mysqli_insert_id($conn);
                $listCart = get_list_buy_cart();
                foreach ($listCart as $item) {
                    $data = array(
                        'id_order' => $id_order,
                        'url_images' => $item['product_img'],
                        'name_product' => $item['product_title'],
                        'price' => $item['price'],
                        'quantity' => $item['qty'],
                    );
                    $insertOrderDetail = db_insert('tbl_order_detail', $data);
                }
                $_SESSION['success'] = "Đã thêm đơn hàng thành công";
                redirect("?mod=order");
            }
            $content = "";
            $content .=
                "<table align='center' bgcolor='#dcf0f8' border='0' cellpadding='0' cellspacing='0' style='margin:0;padding:0 15%;background-color:#ffffff;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px' width='100%'>
                    <tbody>
                        <tr>
                            <td>
                                <h1 style='font-size:18px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0'>Cảm ơn quý khách
                                $fullname đã đặt hàng tại Ismart Store</h1>  
                                <p style='margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px;font-weight:normal'>
                                Ismart rất vui thông báo đơn hàng DH#{$id_order} của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Ismart sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>           
                                <h3 style='font-size:14px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd'>
                                Thông tin đơn hàng DH#{$id_order} <span style='font-size:13px;color:#777;text-transform:none;font-weight:normal'>($today)</span></h3>                
                            </td>
                        </tr>
                        <tr>
                            <td style='font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <thead>
                                        <tr>
                                            <th align='left' style='padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold' width='50%'>Thông tin thanh toán</th>
                                            <th align='left' style='padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;font-weight:bold' width='50%'> Địa chỉ giao hàng </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style='padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px;font-weight:normal' valign='top'><span style='text-transform:capitalize'>Họ và tên: $fullname</span><br>
                                                <a href=' target='_blank'>Địa chỉ email: {$email}</a><br>
                                                Số điện thoại: {$phone}
                                            </td>
                                            <td style='padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px;font-weight:normal' valign='top'><span style='text-transform:capitalize'>$fullname</span><br>
                                                <a href=' target='_blank'>Địa chỉ email: {$email}</a><br>
                                                Địa chỉ giao hàng: {$address}/$name_commune[name]/$name_district[name]/$name_province_city[name]<br>
                                                Số điện thoại: {$phone}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='2' style='padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444' valign='top'>
                                                <p style='font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px;font-weight:normal'>
                                                    <strong>Phương thức thanh toán: </strong> payment_method <br>
                                                    <strong>Thời gian giao hàng dự kiến:</strong> Dự kiến giao hàng giao trong vòng từ 3-5 ngày<br>
                                                    <strong>Phí vận chuyển: </strong> 0đ<br>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2 style='text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:14px;color:#02acea'> CHI TIẾT ĐƠN HÀNG</h2>
                                    <table border='0' cellpadding='0' cellspacing='0' style='background:#f5f5f5' width='100%'>
                                        <thead>           
                                            <tr>
                                                <th align='left' bgcolor='#02acea' style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:14px'>
                                                    Sản phẩm</th>
                                                <th align='left' bgcolor='#02acea' style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:14px'>
                                                    Đơn giá</th>
                                                <th align='left' bgcolor='#02acea' style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:14px;text-align:center'>
                                                    Số lượng</th>
                                                <th align='right' bgcolor='#02acea' style='padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:14px'>
                                                    Tổng tạm</th>
                                            </tr>
                                        </thead>";
            foreach ($listCart as $item) {
                $price = currency_format($item['price']);
                $sub_total = currency_format($item['sub_total']);
                $content .= "
                                                <tbody bgcolor='#eee' style='font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px'>
                                                    <tr>
                                                        <td align='left' style='padding:3px 9px' valign='top'><span>{$item['product_title']}</span><br></td>                       
                                                        <td align='left' style='padding:3px 9px' valign='top'><span>{$price}</span></td>
                                                        <td align='left' style='padding:3px 9px;text-align:center' valign='top'>$item[qty]</td>
                                                        <td align='right' style='padding:3px 9px' valign='top'><span> $sub_total </span></td>
                                                    </tr>
                                                </tbody>";
            }
            $content .= "
                                        <tfoot style='font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#444;line-height:18px'>
                                            <tr>
                                                <td align='right' colspan='3' style='padding:5px 9px'>Phí vận chuyển</td>
                                                <td align='right' style='padding:5px 9px'><span>0đ</span></td>
                                            </tr>
                                            <tr bgcolor='#eee'>
                                                <td align='right' colspan='3' style='padding:7px 9px'><strong><big>Tổng giá trị đơn
                                                            hàng</big> </strong></td>
                                                <td align='right' style='padding:7px 9px'><strong><big><span>$total_price</span> </big>
                                                </strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;
                                <p>Một lần nữa Ismart cảm ơn quý khách.</p><font color='#888888'>
                                <p><strong><a href=' target='_blank' data-saferedirecturl=''>Ismart</a>
                                    </strong></p>
                            </font></td>
                        </tr>
                    </tbody>
                </table>";
            send_mail($email, 'Cửa hàng ISMART', 'Thông báo đặt hàng', $content);
            unset($_SESSION['cart']);
        }
    }
    $data = array(
        'listProducts' => $listProducts,
        'listProvinceCity' => $listProvinceCity,
        'error' => $error
    );
    load_view('add', $data);
}

function seletctDistrictAction()
{
    $id = $_POST['idProvinceCity'];
    $listDistrict = get_list_district_by_id($id);
    $data = "";
    $data .= "<option value='' disabled='disabled'  selected='selected' class='district'>---Chọn Quận/Huyện---</option>";
    foreach ($listDistrict as $item) {
        $data .= "<option value='$item[maqh]'>$item[name]</option>";
    }
    echo json_encode($data);
}

function seletctCommuneAction()
{
    $id = $_POST['idDisTrict'];
    $listCommune = get_list_commune_by_id($id);
    $data = "";
    $data .= "<option value='' disabled='disabled'  selected='selected' class='commune' >---Chọn Xã/Thị Trấn---</option>";
    foreach ($listCommune as $item) {
        $data .= "<option value='$item[xaid]'>$item[name]</option>";
    }
    echo json_encode($data);
}

function checkCustomerAction()
{
    if (isset($_POST['numPhone'])) {
        $numPhone = $_POST['numPhone'];
        $checkCustomer = check_info_customer($numPhone);
        if (!empty($checkCustomer)) {
            $name_district = get_name_district($checkCustomer['maqh']);
            $name_province_city = get_name_province_city($checkCustomer['matp']);
            $name_commune =  get_name_commune($checkCustomer['xaid']);
            $select_name_province_city = "<option value='$checkCustomer[matp]'>$name_province_city[name]</option>";
            $select_name_district = "<option value='$checkCustomer[maqh]'>$name_district[name]</option>";
            $select_name_commune = "<option value='$checkCustomer[xaid]'>$name_commune[name]</option>";
            $data = array(
                'name_district' => $name_district,
                'select_name_province_city' => $select_name_province_city,
                'select_name_district' => $select_name_district,
                'select_name_commune' => $select_name_commune,
                'checkCustomer' => $checkCustomer
            );
            echo json_encode($data);
        } else {
            echo json_encode("Null");
        }
    }
}

function deleteAction()
{
    $id_order = $_GET['id_order'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_order', "`order_id`='$id_order'");
    if (!isset($_GET['page'])) {
        redirect("?mod=order");
    } else if (isset($_GET['page'])) {
        redirect("?mod=order&page={$page_current}");
    }
}

function addproductcartAction()
{
    global $num;
    function add_cart()
    {
        if (isset($_POST['id'])) {
            $product_id = $_POST['id'];
            $get_product_by_id = get_product_by_id($product_id);
            // Thêm thông tin vào giỏ hàng
            $qty = $_POST['qty'];
            if (isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
                $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + 1;
            }
            $_SESSION['cart']['buy'][$product_id] = array(
                'id' => $get_product_by_id['product_id'],
                'product_title' => $get_product_by_id['product_name'],
                'price' => $get_product_by_id['product_price'],
                'product_img' => explode(',', $get_product_by_id['url_images'])[0],
                'code' => $get_product_by_id['product_code'],
                'qty' => $qty,
                'sub_total' => $get_product_by_id['product_price'] * $qty,
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

function deleteCartAction()
{
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        delete_cart($id);
        update_info_cart();
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
}

function searchAction()
{
    if (isset($_POST['searchName'])) {
        $searhName = $_POST['searchName'];
        $listProductSearch = get_list_search($searhName);
        $str = "";
        foreach ($listProductSearch as $item) {
            $price = currency_format($item['product_price']);
            $str .= "<tr>
                    <td class='name_product_order'>$item[product_name]</td>
                    <td>$price</td>
                    <td><input type='number' data-id='$item[product_id]' name='num-order' id='numberOrder-$item[product_id]' class='numberOrder' min='1' value='1'></td>
                    <td><a class='btn btn-add-cart' data-id='$item[product_id]'><i class='fa-solid fa-cart-arrow-down'></i></a></td>
                </tr>";
        }
        echo $str;
    }
}
