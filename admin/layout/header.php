<!DOCTYPE html>
<html>

<head>
    <title>Quản lý ISMART</title>
    <meta charset="UTF-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/grid.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/plugins/ckfinder/ckfinder.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/sweetalert2.all.min.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="?mod=home" title="" id="logo" class="fl-left">ADMIN</a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?mod=pages" title="">Trang</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=pages&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=pages" title="">Danh sách trang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=posts" title="">Bài viết</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=posts&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=posts" title="">Danh sách bài viết</a>
                                </li>
                                <!-- <li>
                                    <a href="?mod=posts&controller=cat" title="">Danh mục bài viết</a>
                                </li> -->
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=products" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=products&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=products" title="">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=products&controller=cat" title="">Danh mục sản phẩm</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=order" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=order&action=add" title="">Thêm mới thủ công</a>
                                </li>
                                <li>
                                    <a href="?mod=order" title="">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="?mod=order&controller=revenue&action=index" title="">Thống kê - báo cáo</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=dashboard&action=menu" title="">Menu</a>
                        </li>
                    </ul>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="public/images/avata_admin.jpg">
                            </div>
                            <h3 id="account" class="fl-right"><?php if (is_login()) {
                                                                   fullname_user_login();
                                                                } ?></h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?mod=users&action=edit" title="Cập nhật thông tin">Cập nhật tài khoản</a></li>
                            <li><a href="?mod=users&action=logout" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>