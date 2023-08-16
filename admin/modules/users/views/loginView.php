<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <title>Trang đăng nhập</title>
</head>

<body>
    <div class="login-container">
        <div class="login-wp">
            <div class="login-wp-title">
                <h1>ĐĂNG NHẬP HỆ THỐNG</h1>
            </div>
            <div class="login-wp-form">
                <form method="post">
                    <div class="login-group">
                        <label for="">Tên đăng nhập</label>
                        <div class="login-item-input">
                            <i class="icon fa-solid fa-user-tie"></i><input type="text" name="username" value="<?php echo set_value('username') ?>" class="login-input" placeholder="Nhập tên tài khoản">
                        </div>
                        <p class="error"><?php echo form_error('username'); ?></p>
                    </div>
                    <div class="login-group">
                        <label for="">Mật khẩu</label>
                        <div class="login-item-input">
                            <i class="icon fa-solid fa-key"></i><input type="password" name="password" class="login-input" placeholder="Nhập mật khẩu">
                            <div id="eye">
                                <i class="icon fas fa-eye"></i>
                            </div>
                        </div>
                        <p class="error"><?php echo form_error('password'); ?></p>
                        <p class="error"><?php echo form_error('account'); ?></p>
                    </div>
                    <div class="login-group">
                        <input type="submit" name="btn_login" class="login--btn" value="ĐĂNG NHẬP">
                    </div>
                    <div class="authen-bottom--login">
                        <div class="wp-left">
                            <input type="checkbox" name="" id="brand"><label for="brand">Ghi nhớ</label>
                        </div>
                        <a href="?mod=users&action=reset" class="link_for_password">Quên mật khẩu</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="public/js/main.js" type="text/javascript"></script>
<?php
// echo $_SESSION['status'];
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
    <script>
        Swal.fire(
            '<?php echo $_SESSION['status']; ?>',
            '',
            '<?php echo $_SESSION['status_code']; ?>')
    </script>
<?php
    unset($_SESSION['status']);
}
?>