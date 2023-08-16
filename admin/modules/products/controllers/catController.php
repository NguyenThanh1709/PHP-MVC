<?php
function construct()
{
    load_model('cat');
}

function indexAction()
{
    $get_dir_lv_0 = get_list_product_cat_lv_0();
    $count_all = get_total();
    $source = get_list_product_cat(); 
    $error = array();
    function data_tree($data_src, $parent_id = 0, $level = 0)
    {
        $result = array();
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $parent_id) {
                $item['level'] = $level;
                $result[] = $item;
                $child = data_tree($data_src, $item['cat_id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    
    $list_parent_cat = data_tree($source, 0, 0);
    //Xử lý phân trang
    $num_per_page = 12;
    $total_row = count($list_parent_cat);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_cat_page = array_slice($list_parent_cat, $start, $num_per_page);
    $base_url = "?mod=products&controller=cat";
    $data = array(
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'page_current' => $page_current,
        'base_url' => $base_url,
        'list_cat_page' => $list_cat_page,
        'list_parent_cat' => $list_parent_cat,
        'count_all' => $count_all,
        'get_dir_lv_0' => $get_dir_lv_0,
    );
    load_view('catIndex', $data);
}

function addAction()
{
    global $succes_insert;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    $source = get_list_product_cat();
    $error = array();
    function data_tree2($data_src, $parent_id = 0, $level = 0)
    {
        $result = array();
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $parent_id) {
                $item['level'] = $level;
                $result[] = $item;
                $child = data_tree2($data_src, $item['cat_id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    $list_parent_cat = data_tree2($source, 0, 0);
    
    if (isset($_POST['btn_add_cat'])) {
        if (empty($_POST['cat_name'])) {
            $error['cat_name'] = "Không được để trống tên danh mục";
        } else {
            $cat_name = $_POST['cat_name'];
        }
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            $slug = $_POST['slug'];
        }
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Vui lòng chọn danh mục";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        if (empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'slug' => $slug,
                'parent_id' =>  $parent_cat,
                'user_id' => $info_user['user_id'],
                'created_date' => date("d/m/y h:m:s")
            );
            $insert_dir_parent = db_insert('tbl_product_cat', $data);
            if ($insert_dir_parent) {
                $_SESSION['success'] = "Thông báo: Thêm danh mục mới thành công";
                redirect("?mod=products&controller=cat");
            }
        }
    }
    if (isset($_POST['btn_add_dir'])) {
        if (empty($_POST['cat_name_dir'])) {
            $error['cat_name_dir'] = "Không được để trống tên danh mục cha";
        } else {
            $cat_name_dir = $_POST['cat_name_dir'];
        }
        if (empty($error['cat_name_dir'])) {
            $slug = create_slug($cat_name_dir);
        }

        if (empty($error)) {
            $data = array(
                'cat_name' => $cat_name_dir,
                'slug' => $slug,
                'parent_id' => 0,
                'user_id' => $info_user['user_id'],
                'created_date' => date("d/m/y h:m:s")
            );
            if (db_insert('tbl_product_cat', $data)) {
                $_SESSION['success'] = "Thông báo: Thêm danh mục cha mới thành công";
                header("refresh: 0.1");
            }
        }
    }
    $data = array(
        'succes_insert' => $succes_insert,
        'error' => $error,
        'list_parent_cat' => $list_parent_cat,
    );
    load_view('catAdd', $data);
}

function updateAction()
{
    global $update;
    $cat_id = $_GET['cat_id'];
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    $info_dir = get_info_dir($cat_id);
    $source = get_list_product_cat();
    $error = array();
    function data_tree3($data_src, $parent_id = 0, $level = 0)
    {
        $result = array();
        foreach ($data_src as $item) {
            if ($item['parent_id'] == $parent_id) {
                $item['level'] = $level;
                $result[] = $item;
                $child = data_tree3($data_src, $item['cat_id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    $list_parent_cat = data_tree3($source, 0, 0);
    if (isset($_POST['btn_update_dir'])) {
        if (empty($_POST['cat_name'])) {
            $error['cat_name'] = "Không được để trống tên danh mục";
        } else {
            $cat_name = $_POST['cat_name'];
        }
        if (empty($error['cat_name_dir'])) {
            $slug = create_slug($cat_name);
        }

        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Vui lòng chọn danh mục";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }

        if (empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'slug' => $slug,
                'parent_id' =>  $parent_cat,
            );
            if (db_update('tbl_product_cat', $data, "`cat_id`='{$cat_id}'")) {
                $update = true;
            }
        }
    }
    $data = array(
        'update' => $update,
        'info_dir' => $info_dir,
        'user_id' => $info_user['user_id'],
        'list_parent_cat' => $list_parent_cat,
    );
    load_view('catUpdate', $data);
}

function delAction()
{
    $cat_id = $_GET['cat_id'];
    $page_current = $_GET['page_current'];
    $delete_cat = db_delete('tbl_product_cat', "`cat_id`=' {$cat_id}'");
    if($delete_cat) {
        $status['delete'] = "Đã xoá dữ liệu thành công";
    }
    redirect("?mod=products&controller=cat&page=$page_current");
}
