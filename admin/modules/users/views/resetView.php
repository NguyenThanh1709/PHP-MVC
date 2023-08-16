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
                <h1>KHÔI PHỤC MẬT KHẨU</h1>
            </div>
            <?php if(!empty($alert)){ ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> <?php echo $alert['send_mail'] ?></p>
            <?php } ?>
            <div class="login-wp-form">
                <form method="post">
                    <div class="login-group">
                        <label for="">Nhập email của bạn</label>
                        <div class="login-item-input">
                            <i class="fa-solid fa-envelope"></i><input type="text" name="email" value="<?php echo set_value('email') ?>" class="login-input" placeholder="Email của bạn là">
                        </div>
                        <p class="error"><?php echo form_error('email'); ?></p>
                    </div>
                    <div class="login-group">
                        <input type="submit" name="btn_email" class="login--btn" value="GỬI YÊU CẦU">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>