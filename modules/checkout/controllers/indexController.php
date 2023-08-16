<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    global $error, $conn, $fullname, $phone, $email, $address, $district, $province_city, $commune, $payment_method;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today = date('d/m/Y - H:i:s');
    $listProvinceCity = get_list_province_city();
    $listBuyCart = get_list_buy_cart();
    $total_price = currency_format(get_total_cart());
    if (isset($_POST['btn_order'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = 'Không được để trống họ và tên';
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['phone'])) {
            $error['phone'] = 'Không được để trống số điện thoại';
        } else if (!is_phone($_POST['phone'])) {
            $error['phone'] = 'Số điện thoại không đúng định dạng';
        } else {
            $phone = $_POST['phone'];
        }
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống email';
        } else if (!is_email($_POST['email'])) {
            $error['email'] = 'Email không đúng định dạng';
        } else {
            $email = $_POST['email'];
        }
        if (empty($_POST['address'])) {
            $error['address'] = 'Không được để trống địa chỉ';
        } else {
            $address = $_POST['address'];
        }
        if (empty($_POST['district'])) {
            $error['district'] = 'Vui lòng chọn Huyện/quận';
        } else {
            $district = $_POST['district'];
        }
        if (empty($_POST['province-city'])) {
            $error['province-city'] = 'Vui lòng chọn Tỉnh/Thành phố';
        } else {
            $province_city = $_POST['province-city'];
        }
        if (empty($_POST['commune'])) {
            $error['commune'] = 'Vui lòng chọn Xã/Thị trấn';
        } else {
            $commune = $_POST['commune'];
        }
        if (empty($_POST['payment-method'])) {
            $error['payment-method'] = 'Vui lòng chọn hình thức thanh toán';
        } else {
            $payment_method = $_POST['payment-method'];
        }
        $note = $_POST['note'];
        if(empty($listBuyCart)){
            $error['list-cart'] = 'Bạn cần chọn sản phẩm để mua và thanh toán!';
        }
        if (empty($error)) {
            $name_province_city = get_name('name','tbl_province_city', "`matp`='$province_city'");
            $name_commune = get_name('name','tbl_commune', "`xaid`='$commune'");
            $name_district = get_name('name','tbl_district',"`maqh`='$district'");
            $data = array(
                'fullname' => $fullname,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'matp' => $province_city,
                'maqh' => $district,
                'xaid' => $commune,
                'note' => $note,
                'status' => "processing",
                'date_order' => date('Y/m/d  H:i:s'),
                'payment_method' => $payment_method,
                'total_price' => get_total_cart(),
            );
            if (db_insert('tbl_order', $data)) {
                $id_order = mysqli_insert_id($conn);
                foreach ($listBuyCart as $item) {
                    $data = array(
                        'id_order' => $id_order,
                        'url_images' => $item['product_img'],
                        'name_product' => $item['product_title'],
                        'price' => $item['price'],
                        'quantity' => $item['qty']
                    );
                    db_insert('tbl_order_detail', $data);
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
                                                    <strong>Phương thức thanh toán: </strong> $payment_method<br>
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
                foreach ($listBuyCart as $item) {
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
                if (send_mail($email, 'Cửa hàng ISMART', 'Thông báo đặt hàng', $content)) {
                    $info_customer = get_info_customer($id_order);
                    $info_product_order = get_info_product_order($id_order);
                    $data1 = array(
                        'info_customer' => $info_customer,
                        'info_product_order' => $info_product_order
                    );
                    unset($_SESSION['cart']);
                    load_view('orderSuccess', $data1);
                }
            };
        }
    }
    $data = array(
        'listProvinceCity' => $listProvinceCity,
        'listBuyCart' => $listBuyCart,
        'error' => $error
    );
    load_view('index', $data);
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
    $data .= "<option value='' disabled='disabled' selected='selected' class='commune' >---Chọn Xã/Thị Trấn---</option>";
    foreach ($listCommune as $item) {
        $data .= "<option value='$item[xaid]'>$item[name]</option>";
    }
    echo json_encode($data);
}
