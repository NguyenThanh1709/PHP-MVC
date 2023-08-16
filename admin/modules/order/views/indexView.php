<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn đặt hàng</h3>
                    <a href="?mod=order&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="notification" id="notification">
                        <p><i class="fa-solid fa-bell"></i><?php echo $_SESSION['success']; unset($_SESSION['success']) ?><span id="close"><i class="fa-solid fa-x"></i></span></p>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a class="<?php if (empty($status)) {
                                                echo 'active';
                                            } ?>" href="?mod=order">Tất cả <span class="count">(<?php echo $num_order ?>)</span></a> |</li>
                            <li class="publish "><a class="<?php if (isset($status) && $status == "processing") {
                                                    echo 'active';
                                                } ?>" href="?mod=order&status=processing">Đang xử lý <span class="count">(<?php echo  $num_order_processing ?>)</span></a> |</li>
                            <li class="pending "><a class="<?php if (isset($status) && $status == "delivering") {
                                                    echo 'active';
                                                } ?>" href="?mod=order&status=delivering">Đang giao <span class="count">(<?php echo  $num_order_delivering ?>)</span></a> |</li>
                            <li class="trash "><a class="<?php if (isset($status) && $status == "delivered") {
                                                    echo 'active';
                                                } ?>" href="?mod=order&status=delivered">Đã giao <span class="count">(<?php echo $num_order_delivered ?>)</span></a> |</li>
                            <li class="trash "><a class="<?php if (isset($status) && $status == "canceled") {
                                                    echo 'active';
                                                } ?>" href="?mod=order&status=canceled">Đã huỷ <span class="count">(<?php echo  $num_order_canceled ?>)</span></a> |</li>
                            <li class="trash"><a class="<?php if (isset($status) && $status == "totol_price") {
                                                    echo 'active';
                                                } ?>" href="?mod=order&controller=revenue&action=index">Doanh thu <span class="count">(<?php echo currency_format($total_price_order_success['total_price_order_success']) ?>)</span></a></li>                    
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key" id="s" placeholder="Nhập số điện thoại hoặc tên khách hàng" value="<?php echo set_value('search') ?>">
                            <input type="submit" name="btn_search" value="Tìm kiếm" >
                            <?php if (!empty($error['key'])) { ?>
                                <p class="noti-search">
                                    <?php echo $error['key'];
                                    unset($error['key']); ?>
                                </p>
                            <?php } ?>
                        </form>
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
                            <div class="table-responsive">
                                <?php if (!empty($list_order_month_paging)) { ?>
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
                                            foreach ($list_order_month_paging as $item) {
                                                $temp++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" value="<?php echo $item['order_id'] ?>" name="id_order[]" class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                    <td><span class="tbody-text"><?php echo "#CODE_" . $item['order_id'] ?></span></td>
                                                    <td class="text-center"><span class="tbody-text"><?php echo $item['fullname'] ?></span>
                                                        <p><?php echo 0 . '' . $item['phone'] ?></p>
                                                    </td>
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
                                                        <a href="?mod=order&action=delete&id_order=<?php echo $item['order_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                        <a href="?mod=order&action=detail&id_order=<?php echo $item['order_id'] ?>" class="btn-icon btn-detail"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="title_noti">
                                        <h1>Không có bản ghi nào!</h1>
                                    </div>
                                <?php  } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php echo get_pagging($num_page, $page, $base_url); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>