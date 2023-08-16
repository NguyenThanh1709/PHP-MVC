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
                    <li>
                        <a href="" title="">Tìm kiếm</a>
                    </li>
                    <?php if (isset($cat_name)) { ?>
                        <li>
                            <a href="" title=""><?php echo $cat_name['cat_name'] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php if (!empty($listProductSearch)) { ?>
                <div class="section" id="list-product-wp">
                    <?php if (isset($numberSearch)) { ?>
                        <div class="section-head">
                            <h3 class="section-title">TÌM ĐƯỢC <?php echo $numberSearch; ?> SẢN PHẨM CÓ TỪ KHOÁ "<?php if (isset($key)) echo $key ?>"</h3>
                        </div>
                    <?php }
                    if (isset($cat_name)) { ?>
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $cat_name['cat_name'] ?></h3>
                        </div>
                    <?php } ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix list_product">
                            <?php foreach ($listProductSearch as $item) {  ?>
                                <li>
                                    <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="thumb wp-item-link">
                                        <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                $link = explode(',', $item['url_images'])[0];
                                                                                echo base_url("admin\\$link");
                                                                            } ?>">
                                    </a>
                                    <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="product-name"><?php if (isset($item)) echo $item['product_name'] ?></a>
                                    <div class="price">
                                        <?php if (isset($item['sale_off']) > 0) { ?>
                                            <span class="new"><?php echo currency_format($item['sale_off']) ?></span>
                                        <?php } else { ?>
                                            <span class="new"><?php echo currency_format($item['product_price']) ?></span>
                                        <?php } ?>
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
                <!-- <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <?php echo get_pagging($num_page, $page, $base_url) ?>
                    </div>
                </div> -->
            <?php } else { ?>
                <div class="section" id="list-product-wp">
                    <div class="wp_img_null">
                        <img src="public/images/icon_no_see.png" alt="Ảnh">
                        <h3><?php if (isset($error['null'])) echo $error['null'] ?></h3>
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
            <?php
            if (isset($_GET['name'])) {
                get_sidebar('filters');
            }
            ?>
            <?php get_sidebar('saleing') ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>