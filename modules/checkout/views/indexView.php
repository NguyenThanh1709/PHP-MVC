<?php

use GuzzleHttp\Promise\Is;

get_header();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="" name="form-checkout">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">

                    <div class="grid">
                        <div class="wp-input">
                            <div class="row">
                                <div class="col l-6">
                                    <label for="fullname">Họ và tên <span>(*)</span></label>
                                    <input type="text" name="fullname" id="" placeholder="Vui lòng điền họ và tên của bạn" value="<?php echo set_value('fullname') ?>">
                                    <?php if (isset($error['fullname'])) { ?>
                                        <p class="noti_error"><?php echo $error['fullname']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-6">
                                    <label for="email">Địa chỉ Email <span>(*)</span></label>
                                    <input type="email" name="email" id="" placeholder="Vui lòng điền địa chỉ email của bạn" value="<?php echo set_value('email') ?>">
                                    <?php if (isset($error['email'])) { ?>
                                        <p class="noti_error"><?php echo $error['email']; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="wp-input">
                            <div class="row">
                                <div class="col l-6">
                                    <label for="phone">Số điện thoại <span>(*)</span></label>
                                    <input type="number" name="phone" id="" placeholder="Vui lòng điền số điện thoại của bạn" value="<?php echo set_value('phone') ?>">
                                    <?php if (isset($error['phone'])) { ?>
                                        <p class="noti_error"><?php echo $error['phone']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-6">
                                    <label for="province-city">Chọn Tỉnh/Thành phố <span>(*)</span></label>
                                    <select name="province-city" id="select-province-city">
                                        <option value="" class="province-city" disabled="disabled" selected="selected">---Chọn Tỉnh/thành phố---</option>
                                        <?php
                                        if (isset($listProvinceCity)) {
                                            foreach ($listProvinceCity as $item) { ?>
                                                <option value="<?php echo $item['matp'] ?>" class=""><?php echo $item['name'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php if (isset($error['province-city'])) { ?>
                                        <p class="noti_error"><?php echo $error['province-city']; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="wp-input">
                            <div class="row">
                                <div class="col l-6">
                                    <label for="district">Chọn Quận/Huyện <span>(*)</span></label>
                                    <select name="district" id="district">
                                        <option value="" class="district" disabled="disabled" selected="selected">---Chọn Quận/Huyện---</option>
                                    </select>
                                    <?php if (isset($error['district'])) { ?>
                                        <p class="noti_error"><?php echo $error['district']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-6">
                                    <label for="district">Chọn Xã/Thị Trấn <span>(*)</span></label>
                                    <select name="commune" id="commune">
                                        <option value="" class="commune" disabled="disabled" selected="selected">---Chọn Xã/Thị Trấn---</option>
                                    </select>
                                    <?php if (isset($error['commune'])) { ?>
                                        <p class="noti_error"><?php echo $error['commune']; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="wp-input">
                            <div class="row">
                                <div class="col l-12">
                                    <label for="address">Địa chỉ <span>(*)</span></label>
                                    <input type="text" name="address" id="" placeholder="Ví dụ: 35, đường Nguyễn Trung Trực">
                                    <?php if (isset($error['address'])) { ?>
                                        <p class="noti_error"><?php echo $error['address']; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="wp-input">
                            <div class="row">
                                <div class="col l-12">
                                    <label for="notes">Ghi chú (Nếu có)</label>
                                    <textarea name="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <?php
                        if (!empty($listBuyCart)) {
                            foreach ($listBuyCart as $item) { ?>
                                <tbody>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $item['product_title'] ?><strong class="product-quantity">x<?php echo $item['qty'] ?></strong></td>
                                        <td class="product-total"><?php echo currency_format($item['sub_total']) ?></td>
                                    </tr>
                                </tbody>
                        <?php  }
                        } ?>
                        <tfoot>
                            <?php if (isset($error['list-cart'])) { ?>
                                <tr>
                                    <td class="noti_error"><?php echo $error['list-cart']; ?><a href="san-pham"> (Click Mua ngay)</a></td>
                                </tr>
                            <?php } else { ?>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price"><?php echo currency_format(get_total_cart()) ?></strong></td>
                                </tr>
                            <?php } ?>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" checked="checked" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán khi nhận hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="btn_order" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
get_footer();
?>