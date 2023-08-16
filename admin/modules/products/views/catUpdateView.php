<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thông tin danh mục</h3>
                </div>
            </div>
            <?php if (isset($update) && $update) { ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> Thông báo: Cập nhật dữ liệu mới thành công!</p>
            <?php header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <div class="grid wide">
                            <div class="row">
                                <div class="col l-4">
                                    <label for="cat_id">Mã danh mục</label>
                                    <input type="text" name="cat_id" id="cat_id" readonly="readonly" class="input--item" value="<?php if(isset($info_dir)) echo $info_dir['cat_id']?>">
                                    <label for="parent_id">Danh mục cha</label>
                                    <select name="parent_cat" class="input-item--select">
                                        <option value="">--- Chọn danh mục ---</option>
                                        <?php if (isset($list_parent_cat)) {
                                            foreach ($list_parent_cat as $item) {
                                        ?>
                                                <option <?php if($info_dir['parent_id'] == $item['cat_id']) {echo "selected ='selected'"; } if (isset($item) && ($item['level'] == 0)) echo "style='background-color: #ddd'" ?> value="<?php if (isset($item)) echo $item['cat_id'] ?>"><?php if (isset($item)) echo str_repeat('--', $item['level']) . $item['cat_name'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col l-4">
                                    <label for="cat_name">Tên danh mục</label>
                                    <input type="text" name="cat_name" id="cat_name" class="input--item"  value="<?php if(isset($info_dir)) echo $info_dir['cat_name']?>">
                                    <label for="slug">slug</label>
                                    <input type="text" name="slug" id="slug" class="input--item"  value="<?php if(isset($info_dir)) echo $info_dir['slug']?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-4">
                                    <label for="date_created">Ngày tạo (*)</label>
                                    <input type="text" name="date_created" readonly="readonly" id="date_created" class="input--item"  value="<?php if(isset($info_dir)) echo $info_dir['created_date']?>">
                                </div>
                                <div class="col l-4">
                                    <label for="user_id">Người tạo (*)</label>
                                    <input type="text" name="user_id" id="username" class="input--item" readonly="readonly" value="<?php if(isset($info_dir)) echo get_fullname($info_dir['user_id'])['fullname'];?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn_update_dir" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_footer();
    ?>