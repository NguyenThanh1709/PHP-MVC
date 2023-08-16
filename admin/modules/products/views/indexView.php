<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=products&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="notification" id="notification">
                        <p><i class="fa-solid fa-bell"></i><?php echo $_SESSION['success'];
                                                            unset($_SESSION['success']) ?><span id="close"><i class="fa-solid fa-x"></i></span></p>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a class="<?php if (empty($status)) {
                                                            echo 'active';
                                                        } ?>" href="?mod=products">Tất cả <span class="count">(<?php echo $count_all_products ?>)</span></a> |</li>
                            <li class="publish "><a class="<?php if (isset($status) && $status == "publish") {
                                                                echo 'active';
                                                            } ?>" href="?mod=products&status=publish">Đã đăng <span class="count">(<?php echo $count_publish ?>)</span></a> |</li>
                            <li class="pending "><a class="<?php if (isset($status) && $status == "pending") {
                                                                echo 'active';
                                                            } ?>" href="?mod=products&status=pending">Chờ xét duyệt<span class="count">(<?php echo $count_pending ?>)</span></a> |</li>
                            <li class="trash "><a class="<?php if (isset($status) && $status == "trash") {
                                                                echo 'active';
                                                            } ?>" href="?mod=products&status=trash">Thùng rác<span class="count">(<?php echo $count_trash ?>)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key" id="s" placeholder="Nhập tên sản phẩm cần tìm">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
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
                                <option value="">Tác vụ</option>
                                <option value="publish">Công khai</option>
                                <option value="pending">Chờ duyệt</option>
                                <option value="trash">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="btn-action" value="Áp dụng">
                            <?php if (!empty($error['actions'])) { ?>
                                <p class="noti-search">
                                    <?php echo $error['actions'];
                                    unset($error['actions']) ?></p>
                            <?php } ?>
                            <?php if (!empty($list_products_page)) { ?>

                                <div class="table-responsive">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Hình ảnh</span></td>
                                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                                <td><span class="thead-text">Giá</span></td>
                                                <td><span class="thead-text">Danh mục</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Tác vụ</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = $start;
                                            foreach ($list_products_page as $item) {
                                                $temp++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" value="<?php echo $item['product_id'] ?>" name="product_id[]" class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php if (isset($item)) echo explode(",", $item['url_images'])[0] ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="tbody-text">
                                                            <a href="?mod=products&action=infoProduct&product_id=<?php echo $item['product_id'] ?>">
                                                                <?php if (isset($item)) {
                                                                    if (strlen($item['product_name']) > 50) {
                                                                        echo substr($item['product_name'], 0, 30) . "...";
                                                                    } else {
                                                                        echo $item['product_name'];
                                                                    }
                                                                } ?></a>
                                                        </span>
                                                    </td>
                                                    <td><span class="tbody-text"><?php if (isset($item)) echo currency_format($item['product_price']) ?></span></td>
                                                    <td><span class="tbody-text"><?php if (isset($item)) echo get_name_dir($item['cat_id'])['cat_name'] ?></span></td>
                                                    <td><span class="tbody-text text-status 
                                                            <?php if (isset($item['product_status']) && $item['product_status'] == 'publish') {
                                                                echo "text-success";
                                                            }
                                                            if (isset($item['product_status']) && $item['product_status'] == 'pending') {
                                                                echo "text-yellow";
                                                            }
                                                            if (isset($item['product_status']) && $item['product_status'] == 'trash') {
                                                                echo "text-red";
                                                            } ?>"><?php if (isset($item)) if (isset($item['product_status']) && $item['product_status'] == 'publish') {
                                                                        echo "Công khai";
                                                                    }
                                                                    if (isset($item['product_status']) && $item['product_status'] == 'pending') {
                                                                        echo "Chờ duyệt";
                                                                    }
                                                                    if (isset($item['product_status']) && $item['product_status'] == 'trash') {
                                                                        echo "Thùng rác";
                                                                    } ?></span></td>
                                                    <td><span class="tbody-text"><?php if (isset($item)) echo get_fullname($item['user_id'])['fullname'] ?></span></td>
                                                    <td colspan="2">
                                                        <a href="?mod=products&action=delete&product_id=<?php echo $item['product_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                        <a href="?mod=products&action=infoProduct&product_id=<?php echo $item['product_id'] ?>" class="btn-icon btn-detail"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
        <?php } else { ?>
            <div class="title_noti">
                <h1>Không có bản ghi nào!</h1>
            </div>
        <?php  } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>