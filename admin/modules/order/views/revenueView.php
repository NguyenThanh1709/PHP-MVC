<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar('') ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">THỐNG KÊ - BÁO CÁO DOANH THU</h3>
                    <a href="?mod=order&controller=revenue&action=exportExcel" title="" id="add-new" class="export-excel fl-left"><i class="fa-solid fa-file-export"></i> XUẤT EXCEL</a>
                </div>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="notification" id="notification">
                        <p><i class="fa-solid fa-bell"></i><?php echo $_SESSION['success'];
                                                            unset($_SESSION['success']) ?><span id="close"><i class="fa-solid fa-x"></i></span></p>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <div class="gird wide">
                            <div class="row">
                                <div class="col l-8">
                                    <form method="POST" class="form-actions">
                                        <select id="selected-option-month" name="search-month">
                                            <option value="0">---Chọn tháng---</option>
                                            <?php
                                            if (!empty($getMonth)) {
                                                foreach ($getMonth as $item) {
                                            ?>
                                                    <option <?php if(isset($dateTime) && $dateTime['mon'] == $item['month']) { echo "selected='selected'";} else if (isset($_POST['search-month']) && $_POST['search-month'] == $item['month']) { echo "selected='selected'";} ?> class="month" value="<?php echo $item['month'] ?>">Tháng <?php echo $item['month'] ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                        <select id="selected-option-year" name="search-year">
                                            <option value="0">---Chọn năm---</option>
                                            <?php
                                            if (!empty($getYear)) {
                                                foreach ($getYear as $item) {
                                            ?>
                                                    <option <?php if(isset($dateTime) && $dateTime['year'] == $item['year']) { echo "selected='selected'";} else if (isset($_POST['search-year']) && $_POST['search-year'] == $item['year']) { echo "selected='selected'";}  ?> class="year" value="<?php echo $item['year'] ?>">Năm <?php echo $item['year'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <input type="submit" name="btn_search" value="Lọc">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                        <div class="table-responsive">
                            <div class="wp_table_data">
                                <div class="wp-left">
                                    <div class="wp-title">
                                        <h1>Chi tiết doanh thu tháng <?php echo $dateTime['mon'] . "/" . $dateTime['year'] ?></h1>
                                    </div>
                                    <table class="table list-table-wp table-order table-order-hover">
                                        <thead>
                                            <tr>
                                                <td><span class="thead-text">#</span></td>
                                                <td><span class="thead-text">Thời gian</span></td>
                                                <td><span class="thead-text">Doanh thu</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($listDay)) {
                                                $temp = 0;
                                                foreach ($listDay as $item) {
                                                    $temp++;
                                            ?>
                                                    <tr>
                                                        <td><span class="thead-text"><?php echo $temp ?></span></td>
                                                        <td class="date-time"><span class="thead-text"><?php echo date("d-m-Y", strtotime($item['Ngay'])) ?></span></td>
                                                        <td><span class="thead-text"><?php echo currency_format($item['DoanhThu']) ?></span></td>
                                                    </tr>
                                                <?php  }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="3">Không có dữ liệu</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="wp-right">
                                    <div class="wp-title">
                                        <h1>Danh sách sản phẩm bán ra tháng <?php echo $dateTime['mon'] . "/" . $dateTime['year'] ?></h1>
                                        <div class="redload">
                                            <a href="?mod=order&controller=revenue&action=index"><i class="fa-solid fa-rotate-right"></i>Tải lại</a>
                                        </div>
                                    </div>
                                    <table class="table list-table-wp table-order">
                                        <thead>
                                            <tr>
                                                <td><span class="thead-text">#</span></td>
                                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                                <td><span class="thead-text">Số lượng bán ra</span></td>
                                                <td><span class="thead-text">Doanh thu từ sản phẩm</span></td>
                                            </tr>
                                        </thead>
                                        <tbody id="list-product-buy-day">
                                            <?php
                                            if (isset($list_product_buy_month)) {
                                                $temp = 0;
                                                foreach ($list_product_buy_month as $item) {
                                                    $temp++;
                                            ?>
                                                    <tr>
                                                        <td><span class="thead-text"><?php echo $temp ?></span></td>
                                                        <td class="text-left"><span class="thead-text"><?php echo $item['name_product'] ?></span></td>
                                                        <td><span class="thead-text"><?php echo $item['SoLuong'] ?></span></td>
                                                        <td><span class="thead-text"><?php echo currency_format($item['DoanhThu']) ?></span></td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot id="paging-product-buy-day">
                                            <tr>
                                                <td colspan="4">
                                                    <div class="section" id="paging-wp">
                                                        <div class="section-detail clearfix" id="paging">
                                                            <?php echo get_pagging($num_page, $page, $base_url); ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>