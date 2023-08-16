<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Bộ lọc</h3>
    </div>
    <form action="" method="GET" id="form-filter-price">
        <input type="hidden" name="_token" value="">
        <table class="tbl_filter">
            <tbody>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>"  value="price_1" id="price_1">
                        <label for="price_1">Dưới 500.000đ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" value="price_2" id="price_2">
                        <label for="price_2">500.000đ -
                            1.000.000đ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" value="price_3" id="price_3">
                        <label for="price_3">1.000.000đ
                            -
                            5.000.000đ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" value="price_4" id="price_4">
                        <label for="price_4">5.000.000đ
                            -
                            10.000.000đ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" value="price_5" id="price_5">
                        <label for="price_5">10.000.000đ
                            -
                            15.000.000đ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" value="price_6" id="price_6">
                        <label for="price_6">15.000.000đ
                            -
                            20.000.000đ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="filter_price" class="<?php if(isset($_GET['name'])){ echo "filter_price_cat";} else echo "filter_price" ; ?>" data-id="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" value="price_7" id="price_7">
                        <label for="price_7">Trên
                            20.000.000đ</label>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>