<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    $listCatParent = get_cat_parent_product();
    $list_product = get_list_product();
    $listProductSelling = get_list_product_selling();
    $num_per_page = 30;
    $total_row = count($list_product);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_product_pages = get_product_page($start, $num_per_page,);
    $base_url = "san-pham";
    /////////////////
    ///Danh mục SP///
    /////////////////
    function has_child1($data_src, $cat_id)
    {
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $cat_id) {
                return true;
            }
        }
        return false;
    }
    function render_menu1($data_src, $parent_id = 0, $level = 0)
    {
        if ($level == 0) {
            $result = "<ul class='list-item'>";
        } else {
            $result = "<ul class='sub-menu'>";
        }
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $parent_id) {
                $result .= "<li>";
                $result .= "<a href='san-pham/$item[slug]-$item[cat_id].html' title=''>{$item['cat_name']}</a>";
                if (has_child1($data_src, $item['cat_id'])) {
                    $result .= render_menu1($data_src, $item['cat_id'], $level + 1);
                }
                $result .= "</li>";
            }
        }
        $result .= "</ul>";
        return $result;
    }
    $get_list_cat_product = render_menu1($listCatParent);

    $data = array(
        'page' => $page,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'list_product_pages' => $list_product_pages,
        'listProductSelling' => $listProductSelling,
        'get_list_cat_product' => $get_list_cat_product
    );
    load_view('index', $data);
}

function detailAction()
{
    $listProductSelling = get_list_product_selling();
    $listCatParent = get_cat_parent_product();
    function has_child($data_src, $cat_id)
    {
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $cat_id) {
                return true;
            }
        }
        return false;
    }
    function render_menu($data_src, $parent_id = 0, $level = 0)
    {
        if ($level == 0) {
            $result = "<ul class='list-item'>";
        } else {
            $result = "<ul class='sub-menu'>";
        }
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $parent_id) {
                $result .= "<li>";
                $result .= "<a href='san-pham/$item[slug]-$item[cat_id].html' title=''>{$item['cat_name']}</a>";
                if (has_child($data_src, $item['cat_id'])) {
                    $result .= render_menu($data_src, $item['cat_id'], $level + 1);
                }
                $result .= "</li>";
            }
        }
        $result .= "</ul>";
        return $result;
    }
    $get_list_cat_product = render_menu($listCatParent);
    $listProductTop = get_list_product_top();
    $product_id = $_GET['product_id'];
    $get_product_by_id = get_product_by_id($product_id);
    $get_product_cat = get_product_by_cat($get_product_by_id['cat_id']);
    $list_images = explode(",", $get_product_by_id['url_images']);
    $data['list_images'] = $list_images;
    $data['get_product_by_id'] = $get_product_by_id;
    $data = array(
        'get_product_cat' => $get_product_cat,
        'list_images' => $list_images,
        'get_list_cat_product' => $get_list_cat_product,
        'listProductTop' => $listProductTop,
        'get_product_by_id' => $get_product_by_id,
        'listProductSelling' => $listProductSelling
    );
    load_view('detail', $data);
}

function findAction()
{
    global $error, $numberSearch;
    $listProductSelling = get_list_product_selling();
    $listCatParent = get_cat_parent_product();
    // Xử lý tìm kiếm ở phần header
    if (isset($_POST['key'])) {
        if (!empty($_POST['key'])) {
            $key = $_POST['key'];
            $error = array();
            $listProductSearch = get_list_search($key);
            if (!empty($listProductSearch)) {
                $numberSearch  = count($listProductSearch);
            } else {
                $error['null'] = "Không tìm thấy sản phẩm nào !";
            }
            function has_child($data_src, $cat_id)
            {
                foreach ($data_src as $item) {
                    if ($item['parent_id'] == $cat_id) {
                        return true;
                    }
                }
                return false;
            }
            function render_menu($data_src, $parent_id = 0, $level = 0)
            {
                if ($level == 0) {
                    $result = "<ul class='list-item'>";
                } else {
                    $result = "<ul class='sub-menu'>";
                }
                foreach ($data_src as $item) {
                    if ($item['parent_id'] == $parent_id) {
                        $result .= "<li>";
                        $result .= "<a href='san-pham/$item[slug]-$item[cat_id].html' title=''>{$item['cat_name']}</a>";
                        if (has_child($data_src, $item['cat_id'])) {
                            $result .= render_menu($data_src, $item['cat_id'], $level + 1);
                        }
                        $result .= "</li>";
                    }
                }
                $result .= "</ul>";
                return $result;
            }
            $get_list_cat_product = render_menu($listCatParent);
            $data = array(
                'listProductSearch' => $listProductSearch,
                'listProductSelling' => $listProductSelling,
                'get_list_cat_product' => $get_list_cat_product,
                'key' => $key,
                'numberSearch' => $numberSearch,
                'error' => $error
            );
            load_view('find', $data);
        } else {
            redirect("?mod=products");
        }
    }
    //Xử lý tìm kiếm dữ liệu đa cấp
    if (isset($_GET['name'])) {
        $cat_id = $_GET['name'];
        $cat_name = get_name_cat($cat_id);
        function data_tree_cat($data, $parent_id = 0)
        {
            $list = array();
            foreach ($data as $item) {
                if ($item['parent_id'] == $parent_id) {
                    $list[] = $item['cat_id'];
                    $child = data_tree_cat($data, $item['cat_id']);
                    $list = array_merge($list, $child);
                }
            }
            return $list;
        }
        $list_product_cat = get_list_product_cat();
        // show_array($list_product_cat);
        $list_cat_id = array_merge(array(0 => $cat_id), data_tree_cat($list_product_cat, $cat_id));
        // show_array($list_cat_id);
        $list_id = implode(",", $list_cat_id);
        // echo $list_id;
        $listProductSearch = get_product_cats($list_id);
        if (!empty($listProductSearch)) {
            $numberSearch  = count($listProductSearch);
        } else {
            $error['null'] = "Không tìm thấy sản phẩm nào !";
        }
        function has_child($data_src, $cat_id)
        {
            foreach ($data_src as $item) {
                if ($item['parent_id'] == $cat_id) {
                    return true;
                }
            }
            return false;
        }
        function render_menu($data_src, $parent_id = 0, $level = 0)
        {
            if ($level == 0) {
                $result = "<ul class='list-item'>";
            } else {
                $result = "<ul class='sub-menu'>";
            }
            foreach ($data_src as $item) {
                if ($item['parent_id'] == $parent_id) {
                    $result .= "<li>";
                    $result .= "<a href='san-pham/$item[slug]-$item[cat_id].html' title=''>{$item['cat_name']}</a>";
                    if (has_child($data_src, $item['cat_id'])) {
                        $result .= render_menu($data_src, $item['cat_id'], $level + 1);
                    }
                    $result .= "</li>";
                }
            }
            $result .= "</ul>";
            return $result;
        }
        $get_list_cat_product = render_menu($listCatParent);
        $data = array(
            'listProductSelling' => $listProductSelling,
            'get_list_cat_product' => $get_list_cat_product,
            'listProductSearch' => $listProductSearch,
            'cat_name' => $cat_name,
            'error' => $error
        );
        load_view('find', $data);
    }
}

function filtersPriceAction()
{
    global $price_min, $price_max, $list_product_pages;
    $tbl_data = "";
    //////////////////////////////////
    //Lọc giá theo danh mục sản phẩm//
    //////////////////////////////////
    if (isset($_GET['catID']) && isset($_GET['selectedCatID'])) {
        $cat_id = $_GET['catID'];
        $key = $_GET['selectedCatID'];
        function data_tree_cat($data, $parent_id = 0)
        {
            $list = array();
            foreach ($data as $item) {
                if ($item['parent_id'] == $parent_id) {
                    $list[] = $item['cat_id'];
                    $child = data_tree_cat($data, $item['cat_id']);
                    $list = array_merge($list, $child);
                }
            }
            return $list;
        }
        $list_product_cat = get_list_product_cat();
        $list_cat_id = array_merge(array(0 => $cat_id), data_tree_cat($list_product_cat, $cat_id));
        $list_id = implode(",", $list_cat_id);
        if ($key == 'price_1') {
            $price_min = 500000;
            $price_max = "";
        } else if ($key == 'price_2') {
            $price_min = 500000;
            $price_max = 1000000;
        } else if ($key == 'price_3') {
            $price_min = 1000000;
            $price_max = 5000000;
        } else if ($key == 'price_4') {
            $price_min = 5000000;
            $price_max = 10000000;
        } else if ($key == 'price_5') {
            $price_min = 10000000;
            $price_max = 15000000;
        } else if ($key == 'price_6') {
            $price_min = 15000000;
            $price_max = 20000000;
        } else {
            $price_min = "";
            $price_max = 20000000;
        }
        $listProductSearch = get_product_arrange_cats($price_min, $price_max, $list_id);
        foreach ($listProductSearch as $item) {
            if (isset($item)) {
                $link = explode(',', $item['url_images'])[0];
                $link_img = base_url("admin\\$link");
                $price = currency_format($item['product_price']);
            }
            $tbl_data .=
                "<li>
                <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='thumb wp-item-link'>
                    <img class='img_item_product' src='$link_img'>
                </a>
                <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='product-name'>$item[product_name]</a>
                <div class='price'>
                    <span class='new'>$price</span>
                </div>
                <div class='action clearfix'>
                    <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='buy-now fl-center'>Xem chi tiết</a>
                </div>
            </li>";
        }
        $data = array(
            'tbl_data' => $tbl_data
        );
    }
    //////////////////////////////
    //Lọc giá tất cả sản phẩm từ//
    ////////////////////////////// 
    else {
        if (isset($_GET['selected'])) {
            $key = $_GET['selected'];
        } else {
            $key = $_GET['checked'];
        }
        $num_per_page = 30;
        if (isset($_GET['pages'])) {
            $page = $_GET['pages'];
        } else {
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
        }
        $start = ($page - 1) * $num_per_page;
        if ($key == 'price_1') {
            $price_min = 500000;
            $price_max = "";
        } else if ($key == 'price_2') {
            $price_min = 500000;
            $price_max = 1000000;
        } else if ($key == 'price_3') {
            $price_min = 1000000;
            $price_max = 5000000;
        } else if ($key == 'price_4') {
            $price_min = 5000000;
            $price_max = 10000000;
        } else if ($key == 'price_5') {
            $price_min = 10000000;
            $price_max = 15000000;
        } else if ($key == 'price_6') {
            $price_min = 15000000;
            $price_max = 20000000;
        } else {
            $price_min = "";
            $price_max = 20000000;
        }
        $listProductFilters = get_product_filters($price_min, $price_max);
        $total_row = count($listProductFilters);
        $list_product_pages = get_product_filters_pages($price_min, $price_max, $start, $num_per_page);
        $base_url = "?mod=products&action=filters&filter=$key";
        $num_page = ceil($total_row / $num_per_page);
        $paging = get_pagging($num_page, $page, $base_url);
        foreach ($list_product_pages as $item) {
            if (isset($item)) {
                $link = explode(',', $item['url_images'])[0];
                $link_img = base_url("admin\\$link");
                $price = currency_format($item['product_price']);
            }
            $tbl_data .=
                "<li>
                <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='thumb wp-item-link'>
                    <img class='img_item_product' src='$link_img'>
                </a>
                <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='product-name'>$item[product_name]</a>
                <div class='price'>
                    <span class='new'>$price</span>
                </div>
                <div class='action clearfix'>
                    <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='buy-now fl-center'>Xem chi tiết</a>
                </div>
            </li>";
        }

        $data = array(
            'paging' => $paging,
            'tbl_data' => $tbl_data,
        );
    }
    echo json_encode($data);
}

function arrangeAction()
{
    $tbl_data = "";
    if (isset($_GET['value'])) {
        $arrange = $_GET['value'];
    } else {
        $arrange = $_GET['arrange'];
    }
    if ($arrange == 'az') {
        $arrange_price = "";
        $arrange_name = 'ASC';
    } else if ($arrange == 'za') {
        $arrange_price = "";
        $arrange_name = 'DESC';
    } else if ($arrange == 'price-max-min') {
        $arrange_price = "DESC";
        $arrange_name = "";
    } else {
        $arrange_price = "ASC";
        $arrange_name = "";
    }
    $listArrange = get_product_arrange($arrange_name, $arrange_price);
    $num_per_page = 30;
    $total_row = count($listArrange);
    $num_page = ceil($total_row / $num_per_page);
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
    }
    $start = ($page - 1) * $num_per_page;
    $list_product_pages = get_product_arrange_page($arrange_name, $arrange_price, $start, $num_per_page,);
    $base_url = "?mod=products&action=arrange&arrage='$arrange'";
    $paging = get_pagging($num_page, $page, $base_url);
    foreach ($list_product_pages as $item) {
        if (isset($item)) {
            $link = explode(',', $item['url_images'])[0];
            $link_img = base_url("admin\\$link");
            $price = currency_format($item['product_price']);
        }
        $tbl_data .=
            "<li>
                    <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='thumb wp-item-link'>
                        <img class='img_item_product' src='$link_img'>
                    </a>
                    <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='product-name'>$item[product_name]</a>
                    <div class='price'>
                        <span class='new'>$price</span>
                    </div>
                    <div class='action clearfix'>
                        <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html' title='' class='buy-now fl-center'>Xem chi tiết</a>
                    </div>
                </li>";
    }
    $data = array(
        'paging' => $paging,
        'tbl_data' => $tbl_data
    );
    echo json_encode($data);
}

function searchAjaxKeyUpAction()
{
    if (isset($_GET['key'])) {
        $key = $_GET['key'];
        $listStr = "";
        $listProductKey = get_list_search($key);
        foreach ($listProductKey as $item) {
            if (isset($item)) {
                $link = explode(',', $item['url_images'])[0];
                $link_img = base_url("admin\\$link");
            }
            $listStr .= "<li>
                            <a href='san-pham/chi-tiet-san-pham/$item[slug]-$item[product_id].html'>
                                <img src='$link_img' alt=''>
                                <p>$item[product_name]</p>
                            </a>
                        </li>";
        }
    }
    echo json_encode($listStr);
}
