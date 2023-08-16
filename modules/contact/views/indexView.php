<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php if (isset($pages)) { ?>
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">LIÊN HỆ VỚI CHÚNG TÔI</h3>
                    </div>
                    <div class="section-detail">
                        <!-- <span class="create-date"><?php echo $pages['created_date'] ?></span> -->
                        <div class="detail">
                            <?php echo $pages['content'] ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('saleing') ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>