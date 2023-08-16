<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">THÔNG TIN TRANG</h3>
                </div>
            </div>
            <?php if (isset($success_update) && $success_update) { ?>
                <div class="notification" id="notification">
                    <p><i class="fa-solid fa-bell"></i>Thông báo: Cập nhật dữ liệu bài viết thành công<span id="close"><i class="fa-solid fa-x"></i></span></p>
                </div>
            <?php header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <div class="grid wide">
                            <div class="group-input-info">
                                <div class="row">
                                    <div class="col l-4">
                                        <div class="group-input--item">
                                            <label for="display-name">Tên trang</label>
                                            <input type="text" name="name_page" value="<?php if(isset($info_page['page_name'])){ echo $info_page['page_name'];} ?>" class="input--item">
                                            <label for="name_title">Tên tiêu đề</label>
                                            <input type="text" name="name_title" value="<?php if(isset($info_page['page_title'])){ echo $info_page['page_title'];} ?>" id="name_title" class="input--item">
                                        </div>
                                    </div>
                                    <div class="col l-4">
                                        <div class="group-input--item">
                                            <label for="tel">Slug</label>
                                            <input type="text" name="slug" value="<?php if(isset($info_page['slug'])){ echo $info_page['slug'];} ?>" id="tel" class="input--item">
                                            <label for="page_status">Chọn trạng thái</label>
                                            <select name="page_status" class="input--item input-item--select">
                                                <option value="">---Trạng thái---</option>
                                                <option <?php if (isset($info_page['page_status']) && $info_page['page_status'] == "publish") echo "selected ='selected'" ?> value="publish">Đã đăng</option>
                                                <option <?php if (isset($info_page['page_status']) && $info_page['page_status'] == "pending") echo "selected ='selected'" ?> value="pending">Chờ duyệt</option>
                                                <option <?php if (isset($info_page['page_status']) && $info_page['page_status'] == "trash") echo "selected ='selected'" ?> value="trash">Bỏ vào thủng rác</option>
                                            </select>     
                                        </div>
                                    </div>
                                </div>
                                <div class="group-input--item">
                                    <div class="row">
                                        <div class="col l-4">
                                            <label for="date_created">Ngày tạo</label>
                                            <input type="text" name="date_created" id="date_created" value="<?php if(isset($info_page['created_date'])){ echo $info_page['created_date'];} ?>" class="input--item" readonly="readonly">
                                        </div>
                                        <div class="col l-4">
                                        <label for="user_created">Người tạo</label>
                                            <input type="text" name="user_created" value="<?php if(isset($info_page['user_id'])){ echo get_fullname($info_page['user_id'])['fullname'];} ?>" id="user_created" readonly="readonly" class="input--item">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l-12">
                                        <label for="desc">Nội dung</label>
                                        <textarea name="desc_page" id="ckeditor" class="ckeditor"><?php if(isset($info_page['content'])) {echo $info_page['content'];} ?></textarea>
                                        <script>
                                            CKEDITOR.replace('ckeditor', {
                                                filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
                                                filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                filebrowserWindowWidth: '1000',
                                                filebrowserWindowHeight: '700'
                                            });
                                        </script>
                                          <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                                    </div>            
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>