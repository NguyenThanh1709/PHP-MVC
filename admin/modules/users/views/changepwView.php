<?php
get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">ĐỔI MẬT KHẨU MỚI</h3>
                    <a href="?mod=users&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <?php if (!empty($alert)) { ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> Thông báo: <?php echo $alert['success'] ?></p>
            <?php header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="pass-old" id="pass-old" placeholder="Nhập mật khẩu cũ"> 
                        <?php if(!empty($error)){?><p class="error"><?php echo form_error('pass-old'); ?></p> <?php } ?>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="pass-new" id="pass-new" placeholder="Nhập mật khẩu mới">
                        <?php if(!empty($error)){?><p class="error"><?php echo form_error('pass-new'); ?></p> <?php } ?>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm-pass" id="confirm-pass" placeholder="Nhập lại mật khẩu mới">
                        <?php if(!empty($error)){?><p class="error"><?php echo form_error('confirm-pass'); ?></p> <?php } ?>
                        <?php if(!empty($error)){?><p class="error"><?php echo form_error('changepw'); ?></p> <?php } ?>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>