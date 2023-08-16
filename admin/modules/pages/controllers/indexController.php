<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $error, $search, $action;
    $list_pages = get_list_pages();
    $count_publist = get_status_publish();
    $count_pending = get_status_pending();
    $count_trash = get_status_trash();
    $count_all = get_status_all();
    //Xử lý phân trang
    $num_per_page = 10;
    $total_row = count($list_pages);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $base_url = "?mod=pages";
    $list_pages_page = get_pages_page($start, $num_per_page,);
    $status = "";
    $search = "";
    //Trường hợp không tồn tại từ khoá nào trên đường dẫn
    if (!isset($_POST['btn-search']) && !isset($_GET['valueSearch']) && !isset($_GET['status'])) {
        $list_pages_page = get_pages_page($start, $num_per_page,);
        $base_url = "?mod=pages";
    }
    //Tồn tại status tìm kiếm
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_pages_status = get_list_pages_status($status);
        $total_row = count($list_pages_status);
        $num_page = ceil($total_row / $num_per_page);
        $list_pages_page = get_pages_page($start, $num_per_page, "`page_status` = '{$status}'");
        $base_url = "?mod=pages&status={$status}";
    }
    //Tìm kiếm theo từ khoá
    if (isset($_POST['btn-search'])) {
        if (empty($_POST['key'])) {
            $error['key'] = "Bạn chưa nhập từ khóa tìm kiếm";
        } else {
            $search = $_POST['key'];
            $num_page = ceil($total_row / $num_per_page);
            $list_pages_page = get_list_search_page($start, $num_per_page, $search);
            $base_url = "?mod=pages&key={$search}";
        }
        if ($total_row == 0) {
            $error['key'] = "Không có dữ liệu cần tìm";
        }
    }
    if (isset($_GET['key']) && !isset($_POST['btn-search'])) {
        $search = $_GET['key'];
        $list_search = search_str($search);
        $total_row = count($list_search);
        $num_page = ceil($total_row / $num_per_page);
        $list_pages_page = get_list_search_page($start, $num_per_page, $search);
        $base_url = "?mod=pages&key={$search}";
    }
    //Tác vụ
    if (isset($_POST['btn-action'])) {
        $str_check = "";
        if (empty($_POST['id_page'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['id_page']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'page_status' => $action,
            );
            update_status($data, $str_check);
            redirect("?mod=pages");
        }
    }
    $data = array(
        'action' => $action,
        'search' => $search,
        'error' => $error,
        'status' => $status,
        'page_current' => $page_current,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'page' => $page,
        'start' => $start,
        'count_all' => $count_all,
        'list_pages_page' => $list_pages_page,
        'count_publist' => $count_publist,
        'count_pending' => $count_pending,
        'count_trash' => $count_trash
    );
    load_view('index', $data);
}

function addAction()
{
    global $error, $success_insert;
    $today = date('d/m/Y - H:i:s');
    if (isset($_POST['btn_add'])) {
        // show_array($_FILES);
        $error = array();
        $username = $_SESSION['user_login'];
        $info_user = get_info_user($username);
        if (empty($_POST['name_pages'])) {
            $error['name_pages'] = "Vui lòng nhập tên trang";
        } else {
            $name_pages = $_POST['name_pages'];
        }
        if (empty($_POST['title_pages'])) {
            $error['title_pages'] = "Vui lòng nhập tiêu đề";
        } else {
            $title_pages = $_POST['title_pages'];
        }
        if (empty($_POST['slug_pages'])) {
            $error['slug_pages'] = "Vui lòng nhập slug";
        } else {
            $slug_pages = $_POST['slug_pages'];
        }
        if (empty($_POST['desc_pages'])) {
            $error['desc_pages'] = "Vui lòng nhập mô tả";
        } else {
            $desc_pages = $_POST['desc_pages'];
        }
        if (empty($error)) {
            $data = array(
                'page_name' => $name_pages,
                'page_title' => $title_pages,
                'slug' => $slug_pages,
                'content' => $desc_pages,
                'user_id' => $info_user['user_id'],
                'created_date' => date('Y/m/d  H:i:s'),
                'page_status' => 'publish'
            );
            $insert_pages = db_insert('tbl_pages', $data);
            if ($insert_pages) {
               $_SESSION['success'] = "Thông báo: Đã thêm trang mới thành công";
               redirect("?mod=pages");
            }
        }
    }
    $data = array(
        'error' => $error,
        'success_insert' => $success_insert
    );
    load_view('add', $data);
}

function updateAction()
{
    global $success_update;
    $id = $_GET['id_pages'];
    $info_page = get_info_page($id);
    if (isset($_POST['btn_update'])) {
        if (empty($_POST['name_page'])) {
            $error['name_page'] = "Vui lòng nhập tên trang";
        } else {
            $name_pages = $_POST['name_page'];
        }
        if (empty($_POST['name_title'])) {
            $error['name_title'] = "Vui lòng nhập tiêu đề";
        } else {
            $title_pages = $_POST['name_title'];
        }
        if (empty($_POST['slug'])) {
            $error['slug'] = "Vui lòng nhập slug";
        } else {
            $slug_pages = $_POST['slug'];
        }
        if (empty($_POST['page_status'])) {
            $error['page_status'] = "Vui lòng chọn trạng thái";
        } else {
            $page_status = $_POST['page_status'];
        }
        $desc_pages = $_POST['desc_page'];
        if (empty($error)) {
            $data = array(
                'page_name' => $name_pages,
                'page_title' => $title_pages,
                'slug' => $slug_pages,
                'content' => $desc_pages,
                'page_status' => $page_status
            );
        }
        $update = db_update('tbl_pages', $data, "`page_id`='$id'");
        if ($update) {
            $success_update = true;
        }
    }
    $data = array(
        'success_update' =>  $success_update,
        'info_page' => $info_page
    );
    load_view('update', $data);
}

function delAction()
{
    $page_current = $_GET['page_current'];
    $id_page = $_GET['id_pages'];
    db_delete('tbl_pages', "`page_id`='$id_page'");
    redirect("?mod=pages&page={$page_current}");
}
