<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách thành viên hệ thống </h3>
                    <a href="?mod=users&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                            <li class="all <?php if (empty($status)) {
                                                echo 'active';
                                            } ?>"><a href="?mod=users&controller=team">Tất cả <span class="count">(<?php echo $count_all ?>)</span></a> |</li>
                            <li class="publish <?php if (isset($status) && $status == "all") {
                                                    echo 'active';
                                                } ?>"><a href="?mod=users&controller=team&permission=all">Admin hệ thống <span class="count">(<?php echo $count_system_admin ?>)</span></a> |</li>
                            <li class="pending <?php if (isset($status) && $status == "post") {
                                                    echo 'active';
                                                } ?>"><a href="?mod=users&controller=team&permission=post">Admin bài viết<span class="count">(<?php echo $count_system_post ?>)</span> |</a></li>
                            <li class="pending <?php if (isset($status) && $status == "page") {
                                                    echo 'active';
                                                } ?>"><a href="?mod=users&controller=team&permission=page">Admin trang<span class="count">(<?php echo $count_system_page ?>)</span> |</a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="key" id="s" placeholder="Nhập từ khoá cần tìm">
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
                                <option <?php if(set_value('action') == 'all'){echo 'selected=selected';}  ?> value="all">Admin hệ thống</option>
                                <option <?php if(set_value('action') == 'post'){echo 'selected=selected';}  ?> value="post">Admin bài viết</option>
                                <option <?php if(set_value('action') == 'page'){echo 'selected=selected';}  ?> value="page">Admin trang</option>
                            </select>
                            <input type="submit" name="btn-action" value="Áp dụng">
                            <?php if (!empty($error['actions'])) { ?>
                                <p class="noti-search">
                                    <?php echo $error['actions'];
                                    unset($error['actions']) ?></p>
                            <?php } ?>
                            <div class="table-responsive">
                                <?php if (!empty($list_team)) { ?>
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Họ và tên</span></td>
                                                <td><span class="thead-text">Tên tài khoản</span></td>
                                                <td><span class="thead-text">Email</span></td>
                                                <td><span class="thead-text">Quyền hạn</span></td>
                                                <td><span class="thead-text">Người tạo</span></td>
                                                <td><span class="thead-text">Ngày tạo</span></td>
                                                <td><span class="thead-text">Tác vụ</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $temp = $start;
                                            foreach ($list_team as $item) {
                                                $temp++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" value="<?php echo $item['user_id'] ?>" name="user_id[]" class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span> </td>
                                                    <td><span class="tbody-text"><?php echo $item['fullname'] ?></h3></span></td>
                                                    <td><span class="tbody-text"><a href="" title=""><?php if (isset($item)) echo $item['username'] ?></a> </span></td>
                                                    <td><span class="tbody-text"><?php echo $item['email'] ?></h3></span></td>
                                                    <td><span class="tbody-text"><?php if ($item['permission'] == 'all') {
                                                                                        echo "Tất cả";
                                                                                    } else if ($item['permission'] == 'post') {
                                                                                        echo "Bài viết";
                                                                                    } else {
                                                                                        echo "Trang";
                                                                                    } ?></h3></span></td>

                                                    <td><span class="tbody-text"><?php if (isset($item)) echo get_fullname($item['user_id'])['fullname'] ?></span></td>
                                                    <td><span class="tbody-text"><?php if (isset($item)) echo $item['created_date'] ?></span></td>
                                                    <td colspan="2">
                                                        <a href="?mod=users&controller=team&action=del&users_id=<?php echo $item['user_id'] ?>&page_current=<?php echo $page_current ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                        <a href="?mod=users&action=edit&users_id=<?php echo $item['user_id'] ?>" class="btn-icon btn-detail"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
get_footer();
?>