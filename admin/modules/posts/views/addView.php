<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm bài viết</h3>
                </div>
            </div>
            <?php if (isset($insert_success) && $insert_success) { ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> Thông báo: Thêm dữ liệu mới thành công!</p>
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
                                    <input type="text" name="post_id" id="post_id" class="input--item" placeholder="Nhập mã bài viết" value="<?php echo set_value('post_id') ?>">
                                    <?php echo form_error('post_id'); ?>
                                    <label>Trạng thái</label>
                                    <select name="status" class="input--item input-item--select">
                                        <option value="0">--- Chọn trạng thái---</option>
                                        <option <?php if(set_value('status') == "pending"){echo 'selected=selected';} ?> value="pending">Chờ duyệt</option>
                                        <option <?php if(set_value('status') == "publish"){echo 'selected=selected';} ?> value="publish">Đã đăng</option>
                                    </select>
                                    <?php echo form_error('status'); ?>
                                </div>
                                <div class="col l-4">
                                    <label for="post_name">Tên bài viết</label>
                                    <input type="text" name="post_name" id="post_name" class="input--item" placeholder="Nhập tên bài viết" value="<?php echo set_value('post_name') ?>">
                                    <?php echo form_error('status'); ?>
                                    <label>Chuyên mục</label>
                                    <select name="category" class="input--item input-item--select parent_id">
                                        <option value="">--- Chọn chuyên mục ---</option>
                                        <option <?php if(set_value('category') == "Tuyển dụng"){echo 'selected=selected';} ?> value="Tuyển dụng">Tuyển dụng</option>
                                        <option <?php if(set_value('category') == "Đánh giá"){echo 'selected=selected';} ?> value="Đánh giá">Đánh giá</option>
                                        <option <?php if(set_value('category') == "Tư vấn"){echo 'selected=selected';} ?> value="Tư vấn">Tư vấn</option>
                                        <option <?php if(set_value('category') == "Mẹo hay"){echo 'selected=selected';} ?> value="Mẹo hay">Mẹo hay</option>
                                    </select>
                                    <?php echo form_error('category'); ?>
                                </div>
                            </div>
                        </div>
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="content" id="content" class="ckeditor"><?php echo set_value('content') ?></textarea>
                        <?php echo form_error('content'); ?>
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
                        <?php echo form_error('file'); ?>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>