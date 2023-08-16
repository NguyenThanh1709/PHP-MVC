<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thông tin banner</h3>
                </div>
            </div>
            <?php if (isset($success) && $success) { ?>
                <div class="notification" id="notification">
                    <p><i class="fa-solid fa-bell"></i>Thông báo: Cập nhật dữ liệu bài viết thành công<span id="close"><i class="fa-solid fa-x"></i></span></p>
                </div>
            <?php
                header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php if (isset($info_banner)) { ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="grid wide">
                                <div class="row">
                                    <div class="col l-4">
                                        <label for="banner_id">Mã banner</label>
                                        <input type="text" name="banner_id" id="banner_id" readonly="readonly" value="<?php if (isset($info_banner)) echo $info_banner['banner_id']; ?>" class="input--item ">
                                        <label>Trạng thái</label>
                                        <select name="status" class="input--item input-item--select">
                                            <option value="0">--- Chọn trạng thái ---</option>
                                            <option <?php if (isset($info_banner) && $info_banner['status'] == "pending") echo "selected='selected'" ?> value="pending">Chờ duyệt</option>
                                            <option <?php if (isset($info_banner) && $info_banner['status'] == "publish") echo "selected='selected'" ?> value="publish">Đã đăng</option>
                                            <option <?php if (isset($info_banner) && $info_banner['status'] == "trash") echo "selected='selected'" ?>value="trash">Thùng rác</option>
                                        </select>

                                        <label for="link-url">Đường dẫn liên kết</label>
                                        <input type="text" name="link-url" id="link-url" value="<?php if (isset($info_banner)) echo $info_banner['link_url']; ?>" class="input--item">
                                    </div>
                                    <div class="col l-4">
                                        <label for="banner_name">Tên banner</label>
                                        <input type="text" name="banner_name" id="banner_name" value="<?php if (isset($info_banner)) echo $info_banner['banner_name']; ?>" class="input--item">
                                        <label for="user_id">Người tạo</label>
                                        <input type="text" name="user_id" readonly="readonly" id="user_id" value="<?php if (isset($info_banner)) echo get_fullname($info_banner['user_id'])['fullname']; ?>" class="input--item">
                                    </div>
                                    <div class="col l-4">
                                        <label for="created_date">Ngày tạo</label>
                                        <input type="text" name="created_date" readonly="readonly" id="created_date" value="<?php if (isset($info_banner)) echo $info_banner['created_date']; ?>" class="input--item">
                                        <label for="file">Chọn hình</label>
                                        <input type="file" name="file">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l-8">
                                        <label for="post_name">Hình banner</label>
                                        <img src="<?php echo $info_banner['url_images'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>