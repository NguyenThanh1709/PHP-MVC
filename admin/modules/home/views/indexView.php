<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="grid wide">
                <div class="row">
                    <div class="col c-3">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $num_success_order ?></h5>
                                <p class="card-text">Đơn hàng giao dịch thành công</p>
                            </div>
                        </div>
                    </div>
                    <div class="col l-3">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">ĐANG XỬ LÝ</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $num_processing ?></h5>
                                <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                            </div>
                        </div>
                    </div>

                    <div class="col l-3">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">DOANH SỐ</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo currency_format($total_price_order_success['total_price_order_success']) ?></h5>
                                <p class="card-text">Doanh số hệ thống</p>
                            </div>
                        </div>
                    </div>
                    <div class="col l-3">
                        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">ĐƠN HÀNG HỦY</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $num_cenceled_order ?></h5>
                                <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table_data">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="title-index" class="fl-left">DANH SÁCH ĐƠN HÀNG MỚI TRONG NGÀY</h3>
                    </div>
                    <?php if (!empty($_SESSION['success'])) { ?>
                        <div class="notification" id="notification">
                            <p><i class="fa-solid fa-bell"></i><?php echo $_SESSION['success'];
                                                                unset($_SESSION['success']) ?><span id="close"><i class="fa-solid fa-x"></i></span></p>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="section section-index" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a class="<?php if (empty($status)) {
                                                                echo 'active';
                                                            } ?>" href="?mod=home">Tất cả <span class="count">(<?php echo $num_new_order ?>)</span></a> |</li>
                                <li class="publish "><a class="<?php if (isset($status) && $status == "processing") {
                                                                    echo 'active';
                                                                } ?>" href="?mod=home&status=processing">Đang xử lý <span class="count">(<?php echo  $num_new_order_processing ?>)</span></a> |</li>
                                <li class="pending "><a class="<?php if (isset($status) && $status == "delivering") {
                                                                    echo 'active';
                                                                } ?>" href="?mod=home&status=delivering">Đang giao <span class="count">(<?php echo  $num_new_order_delivering ?>)</span></a> |</li>
                                <li class="trash "><a class="<?php if (isset($status) && $status == "delivered") {
                                                                    echo 'active';
                                                                } ?>" href="?mod=home&status=delivered">Đã giao <span class="count">(<?php echo $num_new_order_delivered ?>)</span></a> |</li>
                                <li class="trash "><a class="<?php if (isset($status) && $status == "canceled") {
                                                                    echo 'active';
                                                                } ?>" href="?mod=home&status=canceled">Đã huỷ <span class="count">(<?php echo  $num_new_order_canceled ?>)</span></a> |</li>
                            </ul>
                        </div>
                        <div class="actions">
                            <form method="POST" class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option value="processing">Đang xử lý</option>
                                    <option value="delivering">Đang giao</option>
                                    <option value="delivered">Đã giao</option>
                                    <option value="canceled">Huỷ đơn</option>
                                </select>
                                <input type="submit" name="btn_action" value="Áp dụng">

                                <?php if (!empty($list_order_new_paging)) { ?>
                                    <div class="table-responsive">
                                        <table class="table list-table-wp table-order">
                                            <thead>
                                                <tr>
                                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                    <td><span class="thead-text">#</span></td>
                                                    <td><span class="thead-text">Mã</span></td>
                                                    <td><span class="thead-text">Khách hàng</span></td>
                                                    <td><span class="thead-text">Giá trị đơn hàng</span></td>
                                                    <td><span class="thead-text">Trạng thái</span></td>
                                                    <td><span class="thead-text">Thời gian</span></td>
                                                    <td><span class="thead-text">Tác vụ</span></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $temp = 0;
                                                foreach ($list_order_new_paging as $item) {
                                                    $temp++;
                                                ?>
                                                    <tr>
                                                        <td><input type="checkbox" value="<?php echo $item['order_id'] ?>" name="id_order[]" class="checkItem"></td>
                                                        <td><span class="tbody-text "><?php echo $temp ?></h3></span>
                                                        <td><span class="tbody-text "><?php echo $item['order_id'] ?></span></td>
                                                        <td><span class="tbody-text "><?php echo $item['fullname'] ?><p><?php echo 0 . '' . $item['phone'] ?></p></span></td>
                                                        <td><span class="tbody-text "><?php echo currency_format($item['total_price']) ?></span></td>
                                                        <td><span class="tbody-text text-status 
                                                <?php if (isset($item['status']) && $item['status'] == 'delivered') {
                                                        echo "text-success";
                                                    }
                                                    if (isset($item['status']) && $item['status'] == 'processing') {
                                                        echo "text-organd";
                                                    }
                                                    if (isset($item['status']) && $item['status'] == 'delivering') {
                                                        echo "text-yellow";
                                                    }
                                                    if (isset($item['status']) && $item['status'] == 'canceled') {
                                                        echo "text-red";
                                                    } ?>"><?php if (isset($item['status']) && $item['status'] == 'delivered') echo "Đã giao";
                                                            if (isset($item['status']) && $item['status'] == 'processing') echo "Đang xử lý";
                                                            if (isset($item['status']) && $item['status'] == 'delivering') echo "Đang giao";
                                                            if (isset($item['status']) && $item['status'] == 'canceled') echo "Đã huỷ"; ?></span></td>
                                                        <td><span class="tbody-text "><?php echo $item['date_order'] ?></span></td>
                                                        <td colspan="2">
                                                            <a href="?mod=home&action=delete&id_order=<?php echo $item['order_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                            <a id="" data-id="<?php echo $item['order_id'] ?>" class="btn-icon btn-detail btn_view_detai_order_new"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="title_noti">
                                        <h1>Không có bản ghi nào!</h1>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                        <div class="section" id="paging-wp">
                            <div class="section-detail clearfix">
                                <!-- Phân trang -->
                                <?php echo get_pagging($num_page, $page, $base_url); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal_detail_order" id="modal_detail_order">
    <div class="modal-container">
        <header class="header-modal">
            <h3 class="text-header">Chi tiết đơn hàng</h3>
            <i id="icon_close" class="fa-solid fa-xmark"></i>
        </header>
        <div class="modal-body">

            <div class="grid wide">
                <div class="wp_info_customer">
                    <p class="group_info_customer">Thông tin khách hàng</p>
                    <div class="wp_input">
                        <div class="row">
                            <div class="col l-3">
                                <label for="">Họ và tên</label>
                                <input type="text" id="fullname_customer" value="">
                            </div>
                            <div class="col l-3">
                                <label for="">Số điện thoại</label>
                                <input type="text" id="phone_customer">
                            </div>
                            <div class="col l-3">
                                <label for="">Địa chỉ email</label>
                                <input type="text" id="email_customer">
                            </div>
                            <div class="col l-3">
                                <label for="">Thời gian</label>
                                <input type="datetime-local" id="datetime_order" value="" name="datetime_order">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="post">
                <div class="grid wide">
                    <div class="wp_info_customer">
                        <p class="group_info_customer">Thông tin đơn hàng</p>
                        <div class="wp_input">
                            <div class="row">
                                <div class="col l-2">
                                    <label for="">Mã đơn hàng</label>
                                    <input type="text" id="order_id" value="" name="order_id">
                                </div>
                                <div class="col l-3">
                                    <label for="">Giá trị đơn hàng</label>
                                    <input type="text" id="total_price_order" value="">
                                </div>
                                <div class="col l-3">
                                    <label for="">Hình thức thanh toán</label>
                                    <input type="text" id="payment_method" value="">
                                </div>

                                <div class="col l-3">

                                    <label for="">Trạng thái đơn hàng</label>
                                    <select name="status" id="select_option_order">
                                        <option value='processing'>Đang xử lý</option>
                                        <option value='delivered'>Đã giao </option>
                                        <option value='delivering'>Đang giao</option>
                                        <option value='canceled'>Đã huỷ</option>
                                    </select>
                                </div>
                                <div class="col l-1">
                                    <label for="">Tác vụ</label>
                                    <input type="submit" id="btn-update" class="btn-update-status" name="btn-update" value="Cập nhật">
                                </div>

                            </div>
                        </div>
                        <div class="wp_input">
                            <div class="row">
                                <div class="col l-8">
                                    <label for="">Địa chỉ giao hàng</label>
                                    <input type="text" id="address" value="">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="wp_input tbl_order_detai_new">
                        <div class="row">
                            <div class="col l-12">
                                <label for="">Chi tiết sản phẩm</label>
                                <table class="table info-exhibition" id="table_product_new_order">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div id="toast"></div>
<?php get_footer(); ?>