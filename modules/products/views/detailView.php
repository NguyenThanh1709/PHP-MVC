<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chi tiết sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (isset($get_product_by_id)) { ?>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="<?php if (isset($list_images)) echo "admin/{$list_images[0]}" ?>" data-zoom-image="<?php if (isset($list_images)) echo "admin/{$list_images[0]}" ?>" />
                            </a>
                            <div id="list-thumb">
                                <?php foreach ($list_images as $item) { ?>
                                    <a href="" data-image="<?php if (isset($item)) echo "admin/" . $item ?>" data-zoom-image="<?php if (isset($item)) echo "admin/" . $item ?>">
                                        <img id="zoom" src="<?php if (isset($item)) echo "admin/" . $item ?>" />
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="<?php if (isset($list_images)) echo "admin/{$list_images[0]}" ?>" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $get_product_by_id['product_name'] ?></h3>
                            <div class="desc">
                                <?php
                                echo $get_product_by_id['product_desc'];
                                ?>
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status"><?php if ($get_product_by_id['num_add_cart'] > $get_product_by_id['num_check_out']) echo "Còn hàng";
                                                        else {
                                                            echo "Hết hàng";
                                                        } ?></span>
                            </div>
                            <p class="price">
                                <?php if ($get_product_by_id['sale_off'] > 0) { ?>
                                    <span class="new-price"><?php echo currency_format($get_product_by_id['sale_off']) ?></span>
                                    <span class="old-price"><?php echo currency_format($get_product_by_id['product_price']) ?></span>
                                <?php } else { ?>
                                    <span><?php echo currency_format($get_product_by_id['product_price']) ?></span>
                                <?php } ?>
                            </p>
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" min="1" max="<?php echo ($get_product_by_id['num_add_cart']) - ($get_product_by_id['num_check_out']); ?>" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <a title="Thêm giỏ hàng" data-id="<?php echo $get_product_by_id['product_id'] ?>" class="add-cart">Thêm giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="section wp_content" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail content_product">
                        <?php
                        echo $get_product_by_id['content'];
                        ?>
                    </div>

                    <div class="see_next">
                        <a id="see_next_link">Xem Thêm</a>
                    </div>

                </div>
                <?php if (isset($get_product_cat)) { ?>
                    <div class="section" id="same-category-wp">
                        <div class="section-head">
                            <h3 class="section-title">Cùng chuyên mục</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item">
                                <?php foreach ($get_product_cat as $item) { ?>
                                    <li>
                                        <a href="?mod=products&action=detail&product_id=<?php echo $item['product_id'] ?>" title="" class="thumb">
                                            <img class="img_item_product" src="<?php if (isset($item)) {
                                                                                    $link = explode(',', $item['url_images'])[0];
                                                                                    echo base_url("admin\\$link");
                                                                                } ?>">
                                        </a>
                                        <a href="?mod=products&action=detail&product_id=<?php echo $item['product_id'] ?> " title="" class="product-name"><?php echo $item['product_name'] ?></a>
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
<?php } ?>
</div>
<?php
get_footer();
?>