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
    <script src="public/js/sweetalert2.all.min.js" type="text/javascript"></script>

    <title>Khôi phục mật khẩu</title>
</head>

<body>
    <div class="login-container">
        <div class="login-wp">
            <div class="login-wp-title">
                <h1>THIẾT LẬP MẬT KHẨU MỚI</h1>
            </div>
            <?php if(!empty($alert)){ ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> <?php echo $alert['changpw'] ?>.Click <a href="?mod=users&action=login">vào đây </a>để đăng nhập</p>
            <?php } ?>
            <div class="login-wp-form">
                <form method="post">
                    <div class="login-group">
                        <label for="">Nhập mật khẩu mới</label>
                        <div class="login-item-input">
                            <i class="icon fa-solid fa-key"></i><input type="password" name="password-new" class="login-input">
                            <div id="eye">
                                <i class="icon fas fa-eye"></i>
                            </div>
                        </div>
                        <p class="error"><?php echo form_error('password-new'); ?></p>
                    </div>
                    <div class="login-group">
                        <label for="">Xác nhận mật khẩu</label>
                        <div class="login-item-input">
                            <i class="icon fa-solid fa-key"></i><input type="password" name="confirm-pw-new" class="login-input">
                        </div>
                        <p class="error"><?php echo form_error('confirm-pw-new'); ?></p>
                        <p class="error"><?php echo form_error('changepw'); ?></p>
                    </div>
                    <div class="login-group">
                        <input type="submit" name="btn_reset_pass" class="login--btn" value="ĐỔI MẬT KHẨU">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="public/js/main.js" type="text/javascript"></script>