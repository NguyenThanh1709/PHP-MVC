<?php
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <?php get_sidebar('add-users') ?>
                </div>
            </div>
            <?php if (isset($succes_update) && $succes_update) { ?>
                <div class="notification" id="notification">
                    <p><i class="fa-solid fa-bell"></i>Thông báo: Cập nhật dữ liệu bài viết thành công<span id="close"><i class="fa-solid fa-x"></i></span></p>
                </div>
            <?php
                header("refresh: 1.5");
            } ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form action="" method="POST">
                            <div class="grid wide">
                                <div class="group-input-info">
                                    <div class="row">
                                        <div class="col l-4">
                                            <div class="group-input--item">
                                                <label for="display-name">Tên hiển thị</label>
                                                <input type="text" name="fullname" id="display-name" placeholder="Nhập họ và tên " value="<?php if (isset($_POST['fullname'])) echo $_POST['fullname'] ?>" class="input--item">
                                                <?php if (!empty($error)) { ?><?php echo form_error('fullname'); ?> <?php } ?>
                                            <label for="permission">Quyền quản lý</label>
                                            <select name="permission" id="permission" class="input--item">
                                                <option value="">---Chọn quyền quản lý---</option>
                                                <option value="all">Admin quyền cao nhất</option>
                                                <option value="page_post">Admin trang, bài viết</option>
                                                <option value="product_sale">Admin sản phẩm, bán hàng</option>
                                            </select>
                                            <?php if (!empty($error)) { ?><?php echo form_error('permission'); ?> <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col l-4">
                                            <div class="group-input--item">
                                                <label for="username">Tên đăng nhập</label>
                                                <input type="text" name="username" id="add_username" placeholder="Nhập tên tài khoản" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" class="input--item">
                                                <?php if (!empty($error)) { ?> <?php echo form_error('username'); ?> <?php } ?>
                                                <label for="password">Mật khẩu</label>
                                                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" value="" class="input--item">
                                                <?php if (!empty($error)) { ?><?php echo form_error('password'); ?><?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l-4">
                                            <div class="group-input--item">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="add_email" placeholder="Nhập email vào đây" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" class="input--item">
                                                <?php if (!empty($error)) { ?><?php echo form_error('email'); ?><?php } ?>
                                                <label for="tel">Số điện thoại</label>
                                                <input type="tel" name="phone_number" id="tel" placeholder="Nhập số điện thoại vào đây" value="<?php if (isset($_POST['phone_number'])) echo $_POST['phone_number'] ?>" class="input--item">
                                                <?php if (!empty($error)) { ?><?php echo form_error('phone'); ?><?php } ?>
                                            </div>
                                        </div>
                                        <div class="col l-4">
                                            <div class="group-input--item">
                                                <label for="address">Địa chỉ</label>
                                                <textarea name="address" placeholder="Nhập địa chỉ vào đây" id="address" class="address input--item input--item-textarea"><?php if (isset($_POST['address'])) echo $_POST['address'] ?></textarea>
                                                <?php if (!empty($error)) { ?><?php echo form_error('address'); ?><?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="group-input--item">
                                        <button type="submit" name="btn_addAccount" id="btn-submit">Thêm mới</button>
                                    </div>
                                </div>
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