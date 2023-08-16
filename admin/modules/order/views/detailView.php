<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span>MD#</span><span class="detail" id="order_id"><?php if (isset($infoIdOrder)) echo $infoIdOrder['order_id'] ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php if (isset($infoIdOrder)) echo "{$infoIdOrder['phone']} \ {$infoIdOrder['address']}/{$name_commune['name']}/{$name_district['name']}/{$name_province_city['name']}" ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail"><?php if (isset($infoIdOrder)) {
                                                    if ($infoIdOrder['payment_method'] == 'direct-payment') {
                                                        echo "Thanh toán tại cửa hàng";
                                                    }
                                                    if ($infoIdOrder['payment_method'] == 'home-payment') {
                                                        echo "Thanh toán tại nhà";
                                                    }
                                                } ?></span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status" id="select_option_order">
                                <option <?php if (isset($infoIdOrder) && $infoIdOrder['status'] == 'processing') echo "selected='selected" ?> value='processing'>Đang xử lý</option>
                                <option <?php if (isset($infoIdOrder) && $infoIdOrder['status'] == 'delivered') echo "selected='selected" ?> value='delivered'>Đã giao </option>
                                <option <?php if (isset($infoIdOrder) && $infoIdOrder['status'] == 'delivering') echo "selected='selected" ?> value='delivering'>Đang giao</option>
                                <option <?php if (isset($infoIdOrder) && $infoIdOrder['status'] == 'canceled') echo "selected='selected" ?> value='canceled'>Đã huỷ</option>
                            </select>
                            <input type="submit" id="btn_update" name="btn-update" value="Cập nhật đơn hàng">
                        </li>
                    </form>
                </ul>
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($listProduct)) {
                                $k = 0;
                                foreach ($listProduct as $item) {
                                    $k++;
                            ?>
                                    <tr>
                                        <td class="thead-text"><?php echo $k ?></td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img src="<?php if (isset($item)) echo explode(',', $item['url_images'])[0] ?>" alt="">
                                            </div>
                                        </td>
                                        <td class="thead-text"><?php if (isset($item)) echo $item['name_product'] ?></td>
                                        <td class="thead-text"><?php if (isset($item)) echo currency_format($item['price']) ?></td>
                                        <td class="thead-text"><?php if (isset($item)) echo $item['quantity'] ?></td>
                                        <td class="thead-text"><?php if (isset($item)) echo currency_format($item['price'] * $item['quantity']) ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php if (isset($listProduct)) {
                                                        $num = 0;
                                                        foreach ($listProduct as $item) {
                                                            $num += $item['quantity'];
                                                        }
                                                        echo $num;
                                                    }  ?></span>
                            <span class="total"><?php if (isset($listProduct)) {
                                                    $price_all = 0;
                                                    foreach ($listProduct as $item) {
                                                        $price_all += $item['price'];
                                                    }
                                                    echo currency_format($price_all);
                                                }  ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="toast"></div>
<?php
get_footer();
?>