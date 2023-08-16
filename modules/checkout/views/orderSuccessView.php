<?php
get_header();
// print_r($info_product_order);
?>
<div id="main-content-wp" class="list-product-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="Trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="Thong-tin-don-hang.html" title="">Đặt hàng thành công</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (isset($info_product_order)) { ?>
        <div class="wrap clearfix wp-inner wp_noti_order_success">
            <div class="wp_container_noti_success">
                <h2 class="font-weight-bold h4 mb-2 d-block"><i class="fa-solid fa-circle-check mr-2"></i>ĐẶT HÀNG THÀNH CÔNG</h2>
                <p class="">Cảm ơn quý khách đã đặt hàng tại cửa hàng chúng tôi.</p>
                <p>Nhân viên của chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng, thời gian giao hàng chậm nhất là 48h.</p>
            </div>
        </div>
        <?php if (isset($info_customer)) { ?>
            <div class="wrap clearfix">
                <div id="content" class="detail-exhibition wp-inner">
                    <div class="section" id="info">
                        <div class="title h5 font-weight-bold ">Mã đơn hàng: <span class="detail text-order-id">#DH<?php echo $info_customer['order_id']; ?></span></div>
                    </div>
                    <h5 class="mb-1 mt-3 text-title-info"><i class="fa-solid fa-circle-info"></i>Thông tin khách hàng</h5>
                    <div class="section">
                        <div class="table-responsive table-danger">
                            <table class="table info-exhibition">
                                <thead>
                                    <tr>
                                        <td>Họ và tên</td>
                                        <td>Số điện thoại</td>
                                        <td>Email</td>
                                        <td>Địa chỉ</td>
                                        <td>Ghi chú</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo $info_customer['fullname']; ?></td>
                                        <td><?php echo $info_customer['phone']; ?></td>
                                        <td><?php echo $info_customer['email']; ?></td>
                                        <td><?php echo $info_customer['address']; ?></td>
                                        <td><?php echo $info_customer['note']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <h5 class="text-danger mb-1 mt-3 text-title-info"><i class="fa-solid fa-circle-info"></i>Thông tin đơn hàng</h5>
                    <div class="table-responsive table-danger">
                        <table class="table info-exhibition">
                            <thead class="font-weight-bold">
                                <tr>
                                    <td class="thead-text">STT</td>
                                    <td class="thead-text">Ảnh sản phẩm</td>
                                    <td class="thead-text">Tên sản phẩm</td>
                                    <td class="thead-text">Đơn giá</td>
                                    <td class="thead-text">Số lượng</td>
                                    <td class="thead-text">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $k = 0;
                                foreach ($info_product_order as $item) {
                                    $k++;
                                ?>
                                    <tr>
                                        <td class="thead-text"><?php echo $k ?></td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img style="width:75px;heght:auto" src="<?php if (isset($item)) echo "admin/" . $item['url_images'] ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="thead-text"><?php if (isset($item)) echo $item['name_product'] ?></td>
                                        <td class="thead-text"><?php if (isset($item)) echo currency_format($item['price']) ?></td>
                                        <td class="thead-text"><?php if (isset($item)) echo $item['quantity'] ?></td>
                                        <td class="thead-text"><?php if (isset($item)) echo currency_format($item['price'] * $item['quantity']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                            <tfoot class="font-weight-bold">
                                <tr>
                                    <td colspan="5" class="thead-text text_total">Tổng tiền</td>
                                    <td class="thead-text"><?php if (isset($info_customer)) echo currency_format($info_customer['total_price']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="thead-text text_total"><a class="btn-link-product-buy" href="trang-chu.html">Trang chủ</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else {
        echo "Không có sản phẩm";
    } ?>
</div>
<?php
get_footer();
?>