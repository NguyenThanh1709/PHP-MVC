<?php

function construct()
{
    load_model('index');
    // load_model('detail');
}

function indexAction()
{
    $listCatParent = get_cat_parent_product();
    $listProductTop = get_list_product_top();
    $listProductSelling = get_list_product_selling();
    $list_banner = get_list_banners();
    // show_array($list_banner);
    $listSmartPhone = get_list_smart_phone();
    $listProductSale = get_list_prodouct_sale();
    $listLapTop = get_list_laptop();
    $listSlider = get_list_slider();
    /////////////////
    ///Danh mục SP///
    /////////////////
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
        'listSlider' => $listSlider,
        'listLapTop' => $listLapTop,
        'listSmartPhone' => $listSmartPhone,
        'listProductSale' => $listProductSale,
        'listProductSelling' => $listProductSelling,
        'listProductTop' => $listProductTop,
        'get_list_cat_product' => $get_list_cat_product,
        'list_banner' => $list_banner
    );
    load_view('index', $data);
}

// function addAction()
// {
//     echo "Thêm dữ liệu";
// }

