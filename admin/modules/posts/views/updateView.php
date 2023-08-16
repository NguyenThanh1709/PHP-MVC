<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thông tin bài viết</h3>
                </div>
            </div>
            <?php if (isset($update_success) && $update_success) { ?>
                <div class="notification" id="notification">
                    <p><i class="fa-solid fa-bell"></i>Thông báo: Cập nhật dữ liệu bài viết thành công<span id="close"><i class="fa-solid fa-x"></i></span></p>
                </div>
            <?php
                header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="grid wide">
                            <div class="row">
                                <div class="col l-4">
                                    <label for="post_id">Mã bài viết</label>
                                    <input type="text" name="post_id" id="post_id" value="<?php if (isset($infoPost)) echo $infoPost['post_id']; ?>" class="input--item post_id">
                                    <label>Trạng thái</label>
                                    <select name="status" class="input--item input-item--select">
                                        <option value="0">--- Chọn danh mục ---</option>
                                        <option <?php if (isset($infoPost) && $infoPost['post_status'] == "pending") echo "selected='selected'" ?> value="pending">Chờ duyệt</option>
                                        <option <?php if (isset($infoPost) && $infoPost['post_status'] == "publish") echo "selected='selected'" ?> value="publish">Đã đăng</option>
                                        <option <?php if (isset($infoPost) && $infoPost['post_status'] == "trash") echo "selected='selected'" ?>value="trash">Thùng rác</option>
                                    </select>
                                </div>
                                <div class="col l-4">
                                    <label for="post_name">Tên bài viết</label>
                                    <input type="text" name="post_name" id="post_name" value="<?php if (isset($infoPost)) echo $infoPost['post_title']; ?>" class="input--item">
                                    <label>Chuyên mục</label>
                                    <select name="category" class="input--item input-item--select parent_id">
                                        <option value="">--- Chọn chuyên mục ---</option>
                                        <option <?php if (isset($infoPost) && $infoPost['category'] == "Tuyển dụng") echo "selected='selected'" ?> value="Tuyển dụng">Tuyển dụng</option>
                                        <option <?php if (isset($infoPost) && $infoPost['category'] == "Đánh giá") echo "selected='selected'" ?> value="Đánh giá">Đánh giá</option>
                                        <option <?php if (isset($infoPost) && $infoPost['category'] == "Tư vấn") echo "selected='selected'" ?> value="Tư vấn">Tư vấn</option>
                                        <option <?php if (isset($infoPost) && $infoPost['category'] == "Mẹo hay") echo "selected='selected'" ?> value="Mẹo hay">Mẹo hay</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="content" id="content" class="ckeditor"><?php if (isset($infoPost)) echo $infoPost['content'];  ?></textarea>
                        <script>
                            CKEDITOR.replace('ckeditor', {
                                filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserWindowWidth: '1000',
                                filebrowserWindowHeight: '500'
                            });
                        </script>
                        <label for="file">Chọn hình</label>
                        <input type="file" name="file">
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>