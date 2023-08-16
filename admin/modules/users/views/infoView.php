<?php
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
                    <a href="?mod=users&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                <?php if (isset($succes_update) && $succes_update) { ?>
                <div class="notification" id="notification">
                    <p><i class="fa-solid fa-bell"></i>Thông báo: Cập nhật dữ liệu bài viết thành công<span id="close"><i class="fa-solid fa-x"></i></span></p>
                </div>
            <?php
                header("refresh: 1.5");
            } ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <div class="grid wide">
                            <div class="group-input-info">
                                <div class="row">
                                    <div class="col l-4">
                                        <div class="group-input--item">
                                            <label for="display-name">Tên hiển thị</label>
                                            <input type="text" name="display-name" value="<?php if (isset($info_user['fullname'])) {echo $info_user['fullname'];} ?>" class="input--item">                                                                                                                                                                                        
                                            <p class="error"><?php echo form_error('display-name'); ?></p>
                                            <label for="email">Email</label>
                                            <input type="email" name="email" value="<?php if (isset($info_user['email'])) {echo $info_user['email'];} ?>" id="email" class="input--item">                                                                                                                                                          
                                        </div>
                                    </div>
                                    <div class="col l-4">
                                        <div class="group-input--item">
                                            <label for="tel">Số điện thoại</label>
                                            <input type="tel" name="tel" value="<?php if (isset($info_user['phone_number'])) {echo $info_user['phone_number'];} ?>" id="tel" class="input--item">                                                                              
                                            <p class="error"><?php echo form_error('tel'); ?></p>
                                            <label for="username">Tên đăng nhập</label>
                                            <input type="text" name="username" value="<?php if (isset($info_user['username'])) { echo $info_user['username']; } ?>" emailid="username" id="username" placeholder="admin" readonly="readonly" class="input--item">                                                            
                                        </div>
                                    </div>
                                </div>           
                                <div class="row">
                                    <div class="col l-8">
                                        <label for="address">Địa chỉ</label>
                                        <textarea class="input--item input--item-textarea" name="address" id="address"><?php if (isset($info_user['address'])) { echo $info_user['address']; } ?></textarea>                                                                                                                                                                                                                       
                                        <p class="error"><?php echo form_error('address'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>