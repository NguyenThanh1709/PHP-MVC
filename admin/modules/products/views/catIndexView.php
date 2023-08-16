<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh mục sản phẩm</h3>
                    <a href="?mod=products&controller=cat&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="notification" id="notification">
                        <p><i class="fa-solid fa-bell"></i><?php echo $_SESSION['success'];
                                                            unset($_SESSION['success']) ?><span id="close"><i class="fa-solid fa-x"></i></span></p>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail ">
                    <div class="table-responsive">
                        <?php
                        if (isset($list_cat_page)) { ?>
                            <table class="table list-table-wp form-right">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tên danh mục</span></td>
                                        <td><span class="thead-text">Slug (Friend URL)</span></td>
                                        <td><span class="thead-text">Ngày tạo</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Tác vụ</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $temp = $start;
                                    foreach ($list_cat_page as $item) {
                                        $temp++;
                                    ?>
                                        <tr class="<?php if (isset($item['parent_id']) && $item['parent_id'] == 0) echo 'active_table' ?>">
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                            <td><span class="tbody-text"><?php if (isset($item)) echo str_repeat('--', $item['level']) . $item['cat_name'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['slug'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['created_date'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_fullname($item['user_id'])['fullname'] ?></span></td>
                                            <td colspan="2">
                                                <a href="?mod=products&controller=cat&action=del&page_current=<?php echo $page_current ?>&cat_id=<?php echo $item['cat_id'] ?>" class="btn-icon btn-trash"><i class="fa-solid fa-trash"></i></a>
                                                <a href="?mod=products&controller=cat&action=update&cat_id=<?php echo $item['cat_id'] ?>" class="btn-icon btn-detail"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Tổng: <?php echo $count_all ?></p>
                    <?php echo get_pagging($num_page, $page, $base_url); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>