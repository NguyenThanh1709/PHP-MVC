<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            <?php if (isset($listProductSelling)) {
                foreach ($listProductSelling as $item) {
            ?>
                    <li class="clearfix">
                        <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . '-' . $item['product_id'] ?>.html" title="" class="thumb fl-left">
                            <img src="<?php if (isset($item)) {
                                            $link = explode(',', $item['url_images'])[0];
                                            echo base_url("admin\\$link");
                                        } ?>" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . '-' . $item['product_id'] ?>.html" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                            <div class="price">
                                <?php if ($item['discount'] > 0) { ?>
                                    <span class="new"><?php echo currency_format($item['sale_off']) ?></span>
                                <?php } else { ?>
                                    <span class="new"><?php echo currency_format($item['product_price']) ?></span>
                                <?php } ?>
                            </div>
                            <a href="san-pham/chi-tiet-san-pham/<?php echo $item['slug'] . '-' . $item['product_id'] ?>.html" title="" class="buy-now">Xem chi tiết</a>
                        </div>
                    </li>
            <?php }
            } ?>
        </ul>
    </div>
</div>
<?php if (isset($list_banner)) {
    foreach ($list_banner as $item) {
?>
        <div class="section" id="banner-wp">
            <div class="section-detail">
                <a href="<?php echo $item['link_url'] ?>" target="_blank" title="" class="thumb">
                    <img src="<?php echo 'admin/' . $item['url_images'] ?>" alt="">
                </a>
            </div>
        </div>
<?php
    }
} ?>