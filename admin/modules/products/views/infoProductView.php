<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thông tin sản phẩm</h3>
                </div>
            </div>
            <?php if (isset($update_status) && $update_status) { ?>
                <div class="notification" id="notification">
                    <p><i class="fa-solid fa-bell"></i>Thông báo: Cập nhật dữ liệu sản phẩm mới thành công<span id="close"><i class="fa-solid fa-x"></i></span></p>
                </div>
            <?php header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="grid wide">
                            <div class="wp_img">
                                <div class="row">
                                    <div class="col l-4">
                                        <div class="show-picture">
                                            <img src="<?php if (isset($list_images)) echo $list_images[0]; ?>" alt="Ảnh sản phẩm">
                                            <div class="slider-nav">
                                                <div class="prev-btn">
                                                    <i class="fa-solid fa-chevron-left"></i>
                                                </div>
                                                <div class="next-btn">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-thumb">
                                            <?php foreach ($list_images as $item) { ?>
                                                <li class="thumb-item"><a><img src="<?php if (isset($item)) echo $item ?>" alt=""></a></li>
                                            <?php }  ?>
                                        </ul>
                                        <label>Hình ảnh</label>
                                        <div id="uploadFile">
                                            <input type="file" multiple="multiple" name="file[]" id="upload-thumb">
                                        </div>
                                        <label for="sale_off">Giá giảm</label>
                                        <input type="text" name="sale_off" id="sale_off" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['sale_off']; ?>">
                                    </div>
                                    <div class="col l-4">
                                        <label for="product-code">Mã sản phẩm</label>
                                        <input type="text" name="product_code" id="product-code" class="input--item input-product-code" value="<?php if (isset($getProductById)) echo $getProductById['product_id']; ?>">
                                        <label>Trạng thái</label>
                                        <select name="status" class="input--item input-item--select">
                                            <option value="0">--- Chọn danh mục ---</option>
                                            <option <?php if (isset($getProductById) && $getProductById['product_status'] == 'pending') echo "selected ='selected'" ?> value="pending">Chờ duyệt</option>
                                            <option <?php if (isset($getProductById) && $getProductById['product_status'] == 'publish') echo "selected ='selected'" ?> value="publish">Đã đăng</option>
                                            <option <?php if (isset($getProductById) && $getProductById['product_status'] == 'trash') echo "selected ='selected'" ?> value="trash">Thùng rác</option>
                                        </select>
                                        <label for="price">Giá sản phẩm</label>
                                        <input type="text" name="price" id="price" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['product_price']; ?>">
                                        <label for="trademark">Thương hiệu</label>
                                        <input type="text" name="trademark" id="trademark" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['trademark']; ?>">
                                        <label for="user_created">Người tạo</label>
                                        <input type="text" name="user_created" id="user_created" class="input--item" value="<?php if (isset($getProductById)) echo get_fullname($getProductById['user_id'])['fullname']; ?>">

                                    </div>
                                    <div class="col l-4">
                                        <label for="product-name">Tên sản phẩm</label>
                                        <input type="text" name="product_name" id="product-name" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['product_name']; ?>">
                                        <label>Danh mục sản phẩm</label>
                                        <select name="parent_id" class="input--item input-item--select parent_id">
                                            <option value="">--- Chọn danh mục ---</option>
                                            <?php if (isset($list_product_cat)) {
                                                foreach ($list_product_cat as $item) { ?>
                                                    <option <?php if (isset($getProductById) && $getProductById['cat_id'] == $item['cat_id']) echo "selected ='selected'" ?> <?php if (isset($item) && ($item['level'] == 0)) echo "style='background-color: #ddd'" ?> value="<?php if (isset($item)) echo $item['cat_id'] ?>"><?php if (isset($item)) echo str_repeat('---', $item['level']) . $item['cat_name'] ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                        <label for="number_product">Số lượng</label>
                                        <input type="text" name="number_product" id="number_product" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['num_add_cart']; ?>">
                                        <label for="slug">Slug (Friends URL)</label>
                                        <input type="text" name="slug" id="slug" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['slug']; ?>">
                                        <label for="date_created">Ngày tạo</label>
                                        <input type="text" name="date_created" id="date_created" class="input--item" value="<?php if (isset($getProductById)) echo $getProductById['created_date']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l-12">
                                        <label for="desc">Mô tả ngắn</label>
                                        <textarea name="desc" id="desc" class="ckeditor"><?php if (isset($getProductById)) echo $getProductById['product_desc']; ?></textarea>
                                        <script>
                                            CKEDITOR.replace('ckeditor', {
                                                filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                                filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                filebrowserWindowWidth: '1000',
                                                filebrowserWindowHeight: '500'
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l-12">
                                        <label for="detai_product">Thông tin miêu tả</label>
                                        <textarea name="detai_product" id="detai_product" class="ckeditor"><?php if (isset($getProductById)) echo $getProductById['content']; ?></textarea>
                                        <script>
                                            CKEDITOR.replace('ckeditor', {
                                                filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                                filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                filebrowserWindowWidth: '1000',
                                                filebrowserWindowHeight: '500'
                                            });
                                        </script>
                                    </div>
                                </div>
                                <?php if (isset($error['parent_cat'])) echo "<span class='error_form'>{$error['parent_cat']}</span>"; ?>
                                <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                            </div>
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
<?php
get_footer();
?>