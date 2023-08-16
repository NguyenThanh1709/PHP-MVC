<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    if (isset($listSlider)) {
                        foreach ($listSlider as $item) { ?>
                            <div class="item">
                                <img src="<?php if (isset($item)) {
                                                $link = $item['url_images'];
                                                echo base_url("admin\\$link");
                                            } ?>" alt="">
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if (isset($listProductTop)) { ?>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($listProductTop as $item) { ?>
                                <li>
                                    <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="thumb wp-item-link">
                                        <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                $link = explode(',', $item['url_images'])[0];
                                                                                echo base_url("admin\\$link");
                                                                            } ?>">
                                    </a>
                                    <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="product-name"><?php if (isset($item)) echo $item['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php if (isset($item)) echo currency_format($item['product_price']) ?></span>
                                        <!-- <span class="old">6.190.000đ</span> -->
                                    </div>
                                    <div class="action clearfix see_detail_product">
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="buy-now fl-center">Xem chi tiết</a>
                                    </div>
                                </li>
                        <?php }
                        } ?>
                        </ul>
                    </div>
                </div>
                <?php if (isset($listProductSale)) { ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">SẢN PHẢM ĐANG GIẢM GIÁ</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php foreach ($listProductSale as $item) {  ?>
                                    <li class="list-item-product-sale">
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="thumb wp-item-link">
                                            <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                    $link = explode(',', $item['url_images'])[0];
                                                                                    echo base_url("admin\\$link");
                                                                                } ?>">
                                        </a>
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="product-name"><?php if (isset($item)) echo $item['product_name'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php if (isset($item)) echo currency_format($item['sale_off']) ?></span>
                                            <span class="old"><?php if (isset($item)) echo currency_format($item['product_price']) ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="buy-now fl-center">Xem chi tiết</a>
                                        </div>
                                        <div class="home-product-item__sale-off">
                                            <span class="home-product-item__sale-off-percent"><?php echo $item['discount'] ?>%</span>
                                            <span class="home-product-item__sale-off-label">GIẢM</span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($listSmartPhone)) { ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">Điện thoại</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php foreach ($listSmartPhone as $item) {  ?>
                                    <li class="list-item-product-smartphone">
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="thumb wp-item-link">
                                            <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                    $link = explode(',', $item['url_images'])[0];
                                                                                    echo base_url("admin\\$link");
                                                                                } ?>">
                                        </a>
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="product-name"><?php if (isset($item)) echo $item['product_name'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php if (isset($item)) echo currency_format($item['product_price']) ?></span>
                                            <!-- <span class="old">6.190.000đ</span> -->
                                        </div>
                                        <div class="action clearfix">

                                            <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="buy-now fl-center">Xem chi tiết</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($listLapTop)) { ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">LAPTOP</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php foreach ($listLapTop as $item) {  ?>
                                    <li class="list-item-product-laptop">
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="thumb wp-item-link">
                                            <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                    $link = explode(',', $item['url_images'])[0];
                                                                                    echo base_url("admin\\$link");
                                                                                } ?>">
                                        </a>
                                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="product-name"><?php if (isset($item)) echo $item['product_name'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php if (isset($item)) echo currency_format($item['product_price']) ?></span>
                                            <!-- <span class="old">6.190.000đ</span> -->
                                        </div>
                                        <div class="action clearfix">
                                            <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . "-" . $item['product_id'] ?>.html" title="" class="buy-now fl-center">Xem chi tiết</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
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
            <?php get_sidebar('saleing') ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>