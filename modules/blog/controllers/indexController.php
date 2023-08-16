<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $listBlog = get_list_blog();
    $listProductSelling = get_list_product_selling();
    $num_per_page = 8;
    $total_row = count($listBlog);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_post_page = get_post_page($start, $num_per_page,);
    $base_url = "bai-viet";
    $data = array(
        'num_page' => $num_page,
        'page' => $page,
        'base_url' => $base_url,
        'listProductSelling' => $listProductSelling,
        'list_post_page' => $list_post_page
    );
    load_view('index', $data);
}

function detailAction()
{
    $listProductTop = get_list_product_top();
    $post_id = $_GET['blog_id'];
    $infoBlog = get_item_blog($post_id);
    $data = array(
        'infoBlog' => $infoBlog,
        'listProductTop' => $listProductTop
    );
    load_view('detailProduct', $data);
}

function editAction()
{
    
}
