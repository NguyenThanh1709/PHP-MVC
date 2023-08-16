<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <?php if (!empty($list_cart)) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_cart as $item) { ?>
                                <tr>
                                    <td><?php echo '#ĐH'.''. $item['id'] ?></td>
                                    <td>
                                        <a href="" title="" class="thumb">
                                            <img src="<?php if (isset($item)) {
                                                            $link = explode(',', $item['product_img'])[0];
                                                            echo base_url("admin\\$link");
                                                        } ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" title="" class="name-product"><?php echo $item['product_title'] ?></a>
                                    </td>
                                    <td><?php echo currency_format($item['price']) ?></td>
                                    <td>
                                        <input type="number" data-id=<?php echo $item['id'] ?> min="1"  name="num-order" class="num-order" value="<?php echo $item['qty'] ?>">
                                    </td>
                                    <td id="sub_total-<?php echo $item['id'] ?>"><?php echo currency_format($item['sub_total']) ?></td>
                                    <td>
                                        <a data-id=<?php echo $item['id'] ?> title="" class="btn-delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span class="total-price"><?php echo currency_format(get_total_cart()) ?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a  title="" class="delete-all-cart" id="update-cart">Xoá giỏ hàng</a>
                                            <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                <?php } else { ?>
                    <img src="public/images/no-cart.png" alt="" class="img-no-cart">
                    <a class="btn-link-product-buy" href="san-pham">Mua sắm ngay</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div id="toast"></div>
<?php
get_footer();
?>