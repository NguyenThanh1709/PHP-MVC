<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="grid wide">
                            <div class="row">
                                <div class="col l-4">
                                    <label for="slider_name">Tên sider</label>
                                    <input type="text" name="slider_name" id="slider_name" class="input--item" placeholder="Vui lòng nhập tên Slider">
                                    <?php echo form_error('slider_name'); ?>
                                    <label for="file">Chọn slider(*)</label>
                                    <input type="file" name="file">
                                    <?php echo form_error('file'); ?>
                                </div>
                                <div class="col l-4">
                                <label>Trạng thái</label>
                                    <select name="status" class="input--item input-item--select">
                                        <option value="0">--- Chọn trạng thái ---</option>
                                        <option <?php if(set_value('siler_status') == "pending"){echo 'selected=selected';} ?> value="pending">Chờ duyệt</option>
                                        <option <?php if(set_value('siler_status') == "publish"){echo 'selected=selected';} ?> value="publish">Đã đăng</option>
                                    </select>
                                    <?php echo form_error('status'); ?>
                                    
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>