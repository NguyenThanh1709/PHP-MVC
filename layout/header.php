<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <base href="<?php echo base_url(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <link href="public/grid.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- <link href="public/js/toast_js/toastr.css" rel="stylesheet" type="text/css" /> -->
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/sweetalert2.all.min.js" type="text/javascript"></script>
    <!-- <script src="public/js/toast_js/toastr.min.js" type="text/javascript"></script> -->
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="trang-chu.html" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="san-pham" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="bai-viet" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="gioi-thieu.html" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="lien-he.html" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="trang-chu.html" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="san-pham/tim-kiem-san-pham.html" class="from-search">
                                <input type="text" name="key" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" value="<?php if (isset($_POST['key'])) echo $_POST['key'] ?>">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                            <div class="wp-list-product-key-search">
                                <ul id="wp-list"></ul>    
                            </div>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0943.833.031</span>
                            </div>
                           
                            <a href="gio-hang.html" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num" class="number_order"><?php echo get_num_order_cart(); ?></span>
                            </a>
                            <div id="btn_search" class="fl-right"><i class="fa-solid fa-magnifying-glass"></i></div>
                            <form method="POST" id="search-responsive" action="san-pham/tim-kiem-san-pham.html" class="search-responsive">
                                <input type="text" name="key" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" value="<?php if (isset($_POST['key'])) echo $_POST['key'] ?>">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>

                            <div id="cart-wp" class="fl-right">
                                <a href="gio-hang.html" id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num" class="number_order"><?php echo get_num_order_cart(); ?></span>
                                </a>

                                <div id="dropdown">
                                    <!-- <?php // if (!empty(get_num_order_cart())) { 
                                            ?> -->
                                    <div class="wp_noti">
                                        <p class="desc">Có <span class="number_order"><?php echo get_num_order_cart(); ?> </span> <span>sản phẩm</span> trong giỏ hàng</p>
                                        <ul id="list-cart" class="list-cart">
                                            <?php foreach (get_list_buy_cart() as $item) { ?>
                                                <li class="clearfix list_cart--item list_cart_show">
                                                    <a href="gio-hang.html" title="" class="thumb fl-left">
                                                        <img src="<?php if (isset($item)) {
                                                                        $link = explode(',', $item['product_img'])[0];
                                                                        echo base_url("admin\\$link");
                                                                    } ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                                        <p class="price"><?php echo currency_format($item['price']) ?></p>
                                                        <p class="qty">Số lượng: <span class="qty_header"><?php echo $item['qty']; ?></span></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right total_price_cart"><?php echo currency_format(get_total_cart()); ?></p>
                                        </div>
                                        <dic class="action-cart clearfix ">
                                            <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="thanh-toan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    </div>
                                    <!-- <?php // } else { 
                                            ?> -->
                                    <div id="cart_null" class="wp_img_prodcut_null">
                                        <img src="public/images/no-cart.png" alt="">
                                        <p>Chưa có sản phẩm</p>
                                    </div>
                                    <?php // } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>