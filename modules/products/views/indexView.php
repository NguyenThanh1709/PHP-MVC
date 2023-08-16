<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php if (isset($list_product_pages)) { ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head wp_title_product">
                        <h3 class="section-title">TẤT CẢ SẢN PHẨM</h3>
                        <select name="" id="select-option-arrange">
                            <option value="">Sắp xếp</option>
                            <option value="az">Từ A-Z</option>
                            <option value="za">Từ Z-A</option>
                            <option value="price-max-min">Giá cao xuống thấp</option>
                            <option value="price-min-max">Giá thấp lên cao</option>
                        </select>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix list_product">
                            <?php foreach ($list_product_pages as $item) {  ?>
                                <li>
                                    <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="thumb wp-item-link">
                                        <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                $link = explode(',', $item['url_images'])[0];
                                                                                echo base_url("admin\\$link");
                                                                            } ?>">
                                    </a>
                                    <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="product-name"><?php if (isset($item)) echo $item['product_name'] ?></a>
                                    <div class="price">
                                        <?php if ($item['sale_off'] > 0) { ?>
                                            <span class="new"><?php if (isset($item)) echo currency_format($item['sale_off']) ?></span>
                                        <?php } else if($item['sale_off'] == 0) { ?>
                                            <span class="new"><?php if (isset($item)) echo currency_format($item['product_price']) ?></span>
                                        <?php } ?>
                                        <!-- <span class="old">6.190.000đ</span> -->
                                    </div>
                                    <div class="action clearfix">
                                        <!-- <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ hàng</a> -->
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="buy-now fl-center">Xem chi tiết</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail paging-product">
                        <?php echo get_pagging($num_page, $page, $base_url) ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <?php
                    if (isset($get_list_cat_product)) {
                        echo $get_list_cat_product;
                    }
                    ?>
                </div>
            </div>
            <?php get_sidebar('filters') ?>
            <?php get_sidebar('saleing') ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>