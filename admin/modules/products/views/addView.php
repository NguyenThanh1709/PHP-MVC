<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="grid wide">
                            <div class="row">
                                <div class="col l-4">
                                    <label for="product-name">Tên sản phẩm</label>
                                    <input type="text" name="product_name" id="product-name" class="input--item" placeholder="Nhập tên sản phẩm" value="<?php echo set_value('product_name') ?>">
                                    <?php echo form_error('product_name'); ?>
                                    <label for="sale_off">Giá sản phẩm sau khi giảm</label>
                                    <input type="number" name="sale_off" id="sale_off" class="input--item" placeholder="Giá giảm còn" value="<?php echo set_value('sale_off') ?>">
                                    <?php echo form_error('sale_off'); ?>
                                    <label>Trạng thái</label>
                                    <select name="status" class="input--item input-item--select">
                                        <option value="0">--- Chọn trạng thái ---</option>
                                        <option <?php if (set_value('status') == 'pending') {
                                                    echo 'selected=selected';
                                                } ?> value="pending">Chờ duyệt</option>
                                        <option <?php if (set_value('status') == 'publish') {
                                                    echo 'selected=selected';
                                                } ?> value="publish">Đã đăng</option>
                                    </select>
                                    <?php echo form_error('status'); ?>
                                </div>
                                <div class="col l-4">
                                    <label for="price">Giá sản phẩm</label>
                                    <input type="text" name="price" id="price" class="input--item" placeholder="Nhập giá sản phẩm" value="<?php echo set_value('price') ?>">
                                    <?php echo form_error('price'); ?>
                                    <label>Danh mục sản phẩm</label>
                                    <select name="parent_id" class="input--item input-item--select parent_id">
                                        <option value="">--- Chọn danh mục ---</option>
                                        <?php if (isset($list_product_cat)) {
                                            foreach ($list_product_cat as $item) {
                                        ?>
                                                <option <?php if (set_value('parent_id') == $item['cat_id']) {
                                                            echo 'selected=selected';
                                                        } ?> <?php if (isset($item) && ($item['level'] == 0)) echo "style='background-color: #ddd' disabled" ?> value="<?php if (isset($item)) echo $item['cat_id'] ?>"><?php if (isset($item)) echo str_repeat('---', $item['level']) . $item['cat_name'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('parent_id'); ?>
                                </div>
                                <div class="col l-4">
                                    <label for="trademark">Thương hiệu</label>
                                    <input type="text" name="trademark" id="trademark" class="input--item" placeholder="Nhập tên thương hiệu" value="<?php echo set_value('trademark') ?>">
                                    <?php echo form_error('trademark'); ?>
                                    <label for="number_product">Số lượng</label>
                                    <input type="text" name="number_product" id="number_product" class="input--item" placeholder="Nhập số lượng" value="<?php echo set_value('number_product') ?>">
                                    <?php echo form_error('number_product'); ?>
                                </div>
                            </div>
                        </div>
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc" class="ckeditor"></textarea>
                        <?php echo form_error('desc'); ?>
                        <script>
                            CKEDITOR.replace('ckeditor', {
                                filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserWindowWidth: '1000',
                                filebrowserWindowHeight: '500'
                            });
                        </script>
                        <label for="detai_product">Chi tiết</label>
                        <textarea name="detai_product" id="detai_product" class="ckeditor"></textarea>
                        <?php echo form_error('detai_product'); ?>
                        <script>
                            CKEDITOR.replace('ckeditor', {
                                filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserWindowWidth: '1000',
                                filebrowserWindowHeight: '500'
                            });
                        </script>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" multiple="multiple" name="file[]" id="upload-thumb">
                            <?php echo form_error('file'); ?>
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