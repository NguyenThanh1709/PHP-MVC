<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách Banner</h3>
                    <a href="?mod=banners&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                            <li class="all <?php if (empty($status)) {
                                                echo 'active';
                                            } ?>"><a href="?mod=banners">Tất cả <span class="count">(<?php echo $count_all ?>)</span></a> |</li>
                            <li class="publish <?php if (isset($status) && $status == "publish") {
                                                    echo 'active';
                                                } ?>"><a href="?mod=banners&status=publish">Đã đăng <span class="count">(<?php echo $count_publish ?>)</span></a> |</li>
                            <li class="pending <?php if (isset($status) && $status == "pending") {
                                                    echo 'active';
                                                } ?>"><a href="?mod=banners&status=pending">Chờ xét duyệt<span class="count">(<?php echo $count_pending ?>)</span> |</a></li>
                            <li class="trash <?php if (isset($status) && $status == "trash") {
                                                    echo 'active';
                                                } ?>"><a href="?mod=banners&status=trash">Thùng rác<span class="count">(<?php echo $count_trash ?>)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key" id="s" placeholder="Nhập tên banner cần tìm" value="<?php echo set_value('search') ?>">
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
                            <div class="table-responsive">
                                <?php if (!empty($list_banner)) { ?>
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Hình banner</span></td>
                                                <td><span class="thead-text">Tên banner</span></td> 
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Ngày tạo</span></td>
                                                <td><span class="thead-text">Tác vụ</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = 0;
                                            // $temp = $start;
                                            foreach ($list_banner as $item) {
                                                $temp++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" value="<?php echo $item['banner_id'] ?>" name="banner_id[]" class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb img-banner">
                                                            <img src="<?php if (isset($item)) echo $item['url_images'] ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="tbody-text">
                                                            <a href="" title=""><?php if (isset($item)) echo $item['banner_name'] ?></a>
                                                        </span>
                                                    </td>
                                                
                                                    <td><span class="tbody-text text-status 
                                                            <?php if (isset($item['status']) && $item['status'] == 'publish') {
                                                                echo "text-success";
                                                            }
                                                            if (isset($item['status']) && $item['status'] == 'pending') {
                                                                echo "text-yellow";
                                                            }
                                                            if (isset($item['status']) && $item['status'] == 'trash') {
                                                                echo "text-red";
                                                            } ?>"><?php if (isset($item)) if (isset($item['status']) && $item['status'] == 'publish') {
                                                                        echo "Công khai";
                                                                    }
                                                                    if (isset($item['status']) && $item['status'] == 'pending') {
                                                                        echo "Chờ duyệt";
                                                                    }
                                                                    if (isset($item['status']) && $item['status'] == 'trash') {
                                                                        echo "Thùng rác";
                                                                    } ?></span></td>
                                                    <td><span class="tbody-text"><?php if (isset($item)) echo get_fullname($item['user_id'])['fullname'] ?></span></td> 
                                                    <td><span class="tbody-text"><?php if (isset($item)) echo $item['created_date'] ?></span></td>
                                                    <td colspan="2">
                                                        <a href="?mod=banners&action=del&banner_id=<?php echo $item['banner_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                        <a href="?mod=banners&action=update&banner_id=<?php echo $item['banner_id'] ?>" class="btn-icon btn-detail"><i class="fa-solid fa-pen-to-square"></i></a>
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
<?php
get_footer();
?>