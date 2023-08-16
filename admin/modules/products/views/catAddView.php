<?php
get_header();
echo $succes_insert;
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(''); ?>
        <div id="content" class="fl-right">
            <?php if (isset($success) && $success) echo "<span class='success_pass'>Thêm danh mục mới thành công</span>" ?>
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                    <button title="" id="add-new" class="fl-left add_new_dir">Thêm danh mục cha</button>
                </div>
            </div>
            <?php if (isset($succes_insert) && $succes_insert) { ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> Thông báo: Thêm dữ liệu mới thành công!</p>
            <?php header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action="" method="POST">
                        <label for="cat_name">Tên danh mục</label>
                        <input type="text" name="cat_name" id="cat_name" value="<?php if (isset($data['cat_name'])) echo $data['cat_name'] ?>" class="input-item--text">
                        <?php if (isset($error['cat_name'])) echo "<span class='error_form'>{$error['cat_name']}</span>"; ?>
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php if (isset($data['slug'])) echo $data['slug'] ?>" class="input-item--text">
                        <?php if (isset($error['slug'])) echo "<span class='error_form'>{$error['slug']}</span>"; ?>
                        <label>Danh mục cha </label>
                        <select name="parent_cat" class="input-item--select input-item--text">
                            <option value="">--- Chọn danh mục ---</option>
                            <?php if (isset($list_parent_cat)) {
                                foreach ($list_parent_cat as $item) {
                            ?>
                                    <option <?php if (isset($item) && ($item['level'] == 0)) echo "style='background-color: #ddd'" ?> value="<?php if (isset($item)) echo $item['cat_id'] ?>"><?php if (isset($item)) echo str_repeat('--', $item['level']) . $item['cat_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <?php if (isset($error['parent_cat'])) echo "<span class='error_form'>{$error['parent_cat']}</span>"; ?>
                        <button type="submit" name="btn_add_cat" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<div class="modal-add-dir-parent" id="dir-parent">
    <div class="modal-containert">
        <header class="header-modal_add-account">
            <h3 class="text-header">Thêm danh mục cha</h3>
        </header>
        <div class="modal-body">
            <form enctype="multipart/form-data" action="" method="post" class="modal-form">
                <div class="wp_input">
                    <input type="text" value="" name="cat_name_dir">
                </div>
                <div class="authen-btn">
                    <input type="button" value="Huỷ" name="btn_cancel" class="btn-authen btn-authen--cancel">
                    <input type="submit" value="Thêm mới" name="btn_add_dir" class="btn-authen btn-authen--add">
                </div>
            </form>
        </div>
    </div>
</div>