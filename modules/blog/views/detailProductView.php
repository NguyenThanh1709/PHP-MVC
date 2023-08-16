<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content fl-right">
            <?php if (isset($infoBlog)) { ?>
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $infoBlog['post_title'] ?></h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date"><?php echo $infoBlog['created_date'] ?></span>
                        <div class="detail">
                            <?php echo $infoBlog['content']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php if (isset($listProductTop)) { ?>
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($listProductTop as $item) { ?>
                                <li class="clearfix">
                                    <a href="?page=detail_product" title="" class="thumb fl-left">
                                        <img src="<?php if (isset($item)) {
                                                        $link = explode(',', $item['url_images'])[0];
                                                        echo base_url("admin\\$link");
                                                    } ?>">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?page=detail_product" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo $item['product_price'] ?></span>
                                            <!-- <span class="old">7.190.000đ</span> -->
                                        </div>
                                        <a href="" title="" class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <!-- <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>ss
<?php
get_footer();
?>