<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div id="main-content-wp" class="list-post-page">
        <div class="wrap clearfix">
            <?php get_sidebar('') ?>
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Danh sách trang</h3>
                        <a href="?mod=pages&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                                <li class="all ">
                                    <a class="<?php if (empty($status)) {
                                                    echo 'active';
                                                } ?>" href="?mod=pages">Tất cả <span class="count">(<?php echo $count_all ?>)</span> |</a>
                                </li>
                                <li class="publish">
                                    <a class=" <?php if (isset($status) && $status == "publish") {
                                                    echo 'active';
                                                } ?>" href="?mod=pages&status=publish">Đã đăng <span class="count">(<?php echo $count_publist ?>)</span> |</a>
                                </li>
                                <li class="pending ">
                                    <a class="<?php if (isset($status) && $status == "pending") {
                                                    echo 'active';
                                                } ?>" href="?mod=pages&status=pending">Chờ xét duyệt <span class="count">(<?php echo $count_pending ?>)</span> |</a>
                                </li>
                                <li class="trash ">
                                    <a class="<?php if (isset($status) && $status == "trash") {
                                                    echo 'active';
                                                } ?>" href="?mod=pages&status=trash">Thùng rác <span class="count">(<?php echo $count_trash ?>)</span></a>
                                </li>
                            </ul>
                            <div class="wp-search">
                                <form method="POST" class="form-s fl-right">
                                    <input type="text" name="key" id="s" value="<?php if (!empty($search)) echo $search  ?>" placeholder="Nhập tên trang cần tìm">
                                    <input type="submit" name="btn-search" value="Tìm kiếm">
                                    <?php if (!empty($error['key'])) { ?>
                                        <p class="noti-search">
                                            <?php echo $error['key'];
                                            unset($error['key']); ?>
                                        </p>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="actions">
                                <form method="POST" action="" class="form-actions">
                                    <select name="actions" class="input--item-select">
                                        <option value="">---Tác vụ---</option>
                                        <option <?php if (isset($action) && $action == "publish") echo "selected ='selected'" ?> value="publish">Đã đăng</option>
                                        <option <?php if (isset($action) && $action == "pending") echo "selected ='selected'" ?> value="pending">Chờ duyệt</option>
                                        <option <?php if (isset($action) && $action == "trash") echo "selected ='selected'" ?> value="trash">Bỏ vào thủng rác</option>
                                    </select>
                                    <input type="submit" name="btn-action" value="Áp dụng">
                                    <?php if (!empty($error['actions'])) { ?>
                                        <p class="noti-search"><?php echo $error['actions'];
                                                                unset($error['actions']) ?></p>
                                    <?php } ?>
                                    <?php if (!empty($list_pages_page)) { ?>
                                        <div class="table-responsive">
                                            <table class="table list-table-wp">
                                                <thead>
                                                    <tr>
                                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                        <td><span class="thead-text">STT</span></td>
                                                        <td><span class="thead-text">Tên trang</span></td>
                                                        <td><span class="thead-text">Tiêu đề</span></td>
                                                        <td><span class="thead-text">Trạng thái</span></td>
                                                        <td><span class="thead-text">Người tạo</span></td>
                                                        <td><span class="thead-text">Thời gian</span></td>
                                                        <td><span class="thead-text">Tác vụ</span></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $temp = $start;
                                                    foreach ($list_pages_page as $item) {
                                                        $temp++; ?>
                                                        <tr>
                                                            <td><input type="checkbox" value="<?php echo $item['page_id'] ?>" name="id_page[]" class="checkItem"></td>
                                                            <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                            <td><span class="tbody-text"><?php echo $item['page_name'] ?></h3></span>
                                                            <td><span class="tbody-text"><?php echo $item['page_title'] ?></span></td>
                                                            <td><span class="tbody-text text-status 
                                                            <?php if (isset($item['page_status']) && $item['page_status'] == 'publish') {
                                                                echo "text-success";
                                                            }
                                                            if (isset($item['page_status']) && $item['page_status'] == 'pending') {
                                                                echo "text-yellow";
                                                            }
                                                            if (isset($item['page_status']) && $item['page_status'] == 'trash') {
                                                                echo "text-red";
                                                            } ?>"><?php if (isset($item)) if (isset($item['page_status']) && $item['page_status'] == 'publish') {
                                                                        echo "Công khai";
                                                                    }
                                                                    if (isset($item['page_status']) && $item['page_status'] == 'pending') {
                                                                        echo "Chờ duyệt";
                                                                    }
                                                                    if (isset($item['page_status']) && $item['page_status'] == 'trash') {
                                                                        echo "Thùng rác";
                                                                    } ?></span></td>
                                                            </span></td>
                                                            <td><span class="tbody-text"><?php echo get_fullname($item['user_id'])['fullname'] ?></span></td>
                                                            <td><span class="tbody-text"><?php echo $item['created_date'] ?></span></td>
                                                            <td colspan="2">
                                                                <a href="?mod=pages&action=del&id_pages=<?php echo $item['page_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                                <a href="?mod=pages&action=update&id_pages=<?php echo $item['page_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-detail"><i class="fa-solid fa-pen-to-square"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="section" id="paging-wp">
                                                <div class="section-detail clearfix">
                                                    <?php echo get_pagging($num_page, $page, $base_url); ?>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="title_noti">
                                                <h1>Không có bản ghi nào!</h1>
                                            </div>
                                        <?php } ?>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>