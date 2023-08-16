<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    global $pages;
    $pages = get_info_pages_contact();
    $listProductSelling = get_list_product_selling();
    // print_r($pages);
    $data = array(
        'pages' => $pages,
        'listProductSelling' => $listProductSelling
    );
    load_view('index', $data);
}

