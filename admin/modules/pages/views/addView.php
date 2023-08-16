<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="grid wide">
                        <form enctype="multipart/form-data" method="POST">
                            <div class="row">
                                <div class="col l-4">
                                    <label for="title">Tên trang</label>
                                    <input type="text" name="name_pages" id="title" class="input--item"  placeholder="Nhập tên trang">
                                    <?php echo form_error('name_pages'); ?>
                                </div>
                                <div class="col l-4">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" name="title_pages" id="title" class="input--item" placeholder="Nhập tiêu đề trang">
                                    <?php echo form_error('title_pages'); ?>
                                </div>
                                <div class="col l-4">
                                    <label for="title">Slug ( Friendly_url )</label>
                                    <input type="text" name="slug_pages" id="slug" class="input--item" placeholder="Nhập slug vào">
                                    <?php echo form_error('slug_pages'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-8">
                                    <label for="desc">Nội dung</label>
                                    <textarea name="desc_pages" id="ckeditor" class="ckeditor"></textarea>
                                    <script>
                                        CKEDITOR.replace('ckeditor', {
                                            filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                            filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                            filebrowserWindowWidth: '1000',
                                            filebrowserWindowHeight: '700'
                                        });
                                    </script>
                                    <?php echo form_error('desc_pages'); ?>
                                </div>
                            </div>
                            <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>