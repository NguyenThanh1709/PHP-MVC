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
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php if (isset($list_post_page)) { ?>
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Bài viết</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($list_post_page as $item) { ?>
                                <li class="clearfix">
                                    <a href="bai-viet/chi-tiet-bai-viet-<?php echo $item['slug'] . "-" . $item['post_id'] ?>.html" title="" class="thumb fl-left">
                                        <img src="<?php if (isset($item)) {
                                                        $link = explode(',', $item['url_images'])[0];
                                                        echo base_url("admin\\$link");
                                                    } ?>">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="bai-viet/chi-tiet-bai-viet-<?php echo $item['slug'] . "-" . $item['post_id'] ?>.html" title="" class="title"><?php echo $item['post_title'] ?></a>
                                        <span class="create-date">28/11/2017</span>
                                        <p class="category-text">Chuyên mục: <span class="name-category"><?php echo $item['category'] ?></span></p>
                                        <!-- <p class="desc"><?php echo $item['content'] ?></p> -->
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php echo get_pagging($num_page, $page, $base_url) ?>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('saleing') ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>