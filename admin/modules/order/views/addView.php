<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm đơn hàng</h3>
                </div>
            </div>
            <?php if (isset($succes_insert) && $succes_insert) { ?>
                <p class="noti--success"><i class="fa-solid fa-bell"></i> Thông báo: Thêm dữ liệu mới thành công!</p>
            <?php header("refresh: 1.5");
            } ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" name="phone" id="phone" class="input--item input-item--check-phone" placeholder="Vui lòng nhập số điện thoại">
                        <a class="btn_check--phone" id="btn_check--phone"><i class="fa-sharp fa-solid fa-user-check"></i>Kiểm tra</a>
                        <div class="grid wide">
                            <div class="row">
                                <div class="col l-4">
                                    <label for="fullname">Họ tên khách hàng <span>(*)</span></label>
                                    <input type="text" name="fullname" id="fullname" class="input--item" placeholder="Vui lòng nhập tên khách hàng">
                                    <?php if (isset($error['fullname'])) { ?>
                                        <p class="noti_error"><?php echo $error['fullname']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-4">
                                    <label for="email">Email <span>(*)</span></label>
                                    <input type="text" name="email" class="input--item" placeholder="Vui lòng nhập email">
                                    <?php if (isset($error['email'])) { ?>
                                        <p class="noti_error"><?php echo $error['email']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-4">
                                    <label for="province-city">Chọn Tỉnh/Thành phố <span>(*)</span></label>
                                    <select class="select" name="province-city" id="select-province-city">
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
                            <div class="row">
                                <div class="col l-4">
                                    <label for="district">Chọn Quận/Huyện <span>(*)</span></label>
                                    <select class="select" name="district" id="district">
                                        <option value="" class="district" disabled="disabled" selected="selected">---Chọn Quận/Huyện---</option>
                                    </select>
                                    <?php if (isset($error['district'])) { ?>
                                        <p class="noti_error"><?php echo $error['district']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-4">
                                    <label for="district">Chọn Xã/Thị Trấn <span>(*)</span></label>
                                    <select class="select" name="commune" id="commune">
                                        <option value="" class="commune" disabled="disabled" selected="selected">---Chọn Xã/Thị Trấn---</option>
                                    </select>
                                    <?php if (isset($error['commune'])) { ?>
                                        <p class="noti_error"><?php echo $error['commune']; ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col l-4">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address" class="input--item" placeholder="Ví dụ: Số 68, đường Lâm Quang Ky">
                                    <?php if (isset($error['address'])) { ?>
                                        <p class="noti_error"><?php echo $error['address']; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-6">
                                    <div class="wp_title">
                                        <h1>Danh sách sản phẩm</h1>
                                    </div>
                                    <div class="wp_function">
                                        <input type="text" id="search_product--mod-order" placeholder="Nhập từ khoá tìm kiếm" class="input--item input--item-search-product">
                                        <!-- <a href="" class="btn"><i class="fa-solid fa-cart-arrow-down"></i></a> -->
                                    </div>
                                    <div class="wp_table table-product--add">
                                        <table class="table list-table-wp ">
                                            <thead>
                                                <tr>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Tác vụ</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data-row-product-search">
                                                <?php
                                                if (isset($listProducts)) {
                                                    foreach ($listProducts as $item) {
                                                ?>
                                                        <tr>
                                                            <td class="name_product_order"><?php if (strlen($item['product_name']) > 20) {
                                                                                                echo substr($item['product_name'], 0, 35) . "...";
                                                                                            } else {
                                                                                                echo $item['product_name'];
                                                                                            } ?></td>
                                                            <td><?php echo currency_format($item['product_price']) ?></td>
                                                            <td><input type="number" data-id="<?php echo $item['product_id'] ?>" id="numberOrder-<?php echo $item['product_id'] ?>" class="numberOrder" min="1" value="1"></td>
                                                            <td> <a class="btn btn-add-cart" data-id="<?php echo $item['product_id'] ?>"><i class="fa-solid fa-cart-arrow-down"></i></a></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col l-6">
                                    <div class="wp_title">
                                        <h1>Danh sách sản phẩm chọn mua</h1>
                                    </div>
                                    <div class="wp_function">               
                                        <a id="btn-delete-cart" class="btn"><i class="fa-sharp fa-solid fa-trash"></i> Xoá</a>
                                    </div>

                                    <table class="table list-table-wp table-list-select-cart">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="" id="checkAll"></th>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá</th>
                                                <th>S.lượng</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-list-order-add">
                                            <?php
                                            if (!empty(get_list_buy_cart())) {
                                                foreach (get_list_buy_cart() as $item) { ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="" class="checkItem" value="<?php echo $item['id'] ?>" id=""></td>
                                                        <td><?php echo $item['product_title'] ?></td>
                                                        <td><?php echo currency_format($item['price']) ?></td>
                                                        <td><?php echo $item['qty'] ?></td>
                                                        <td><?php echo currency_format($item['sub_total']) ?></td>
                                                    </tr>
                                            <?php  }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <p class="total_price_order">Giá trị đơn hàng: <span id="total_price"><?php echo currency_format(get_total_cart()); ?></span></p>
                                </div>      
                            </div>
                        </div>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="toast"></div>
<?php
get_footer();
?>