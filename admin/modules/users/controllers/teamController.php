<?php
function construct()
{
    load_model('team');
}

function indexAction(){
    global $active, $error, $action;
    $error = array();
    $active = $_GET['controller'];
    $get_list_team = get_list_team();
    $count_system_admin = count_system_admin();
    $count_system_post = count_post_admin();
    $count_system_page = count_page_admin();
    $num_per_page = 10;
    $total_row = count($get_list_team);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_team = get_team_page($start, $num_per_page,);
    $base_url = "?mod=users&controller=team";
    $status = "";
    if (!isset($_GET['permission']) && !isset($_POST['btn_search']) && !isset($_POST['btn_search'])) {
        $list_team = get_team_page($start, $num_per_page,);
        $base_url = "?mod=users&controller=team";
    }
    if (isset($_GET['permission'])) {
        $status = $_GET['permission'];
        $list_team_page = get_list_pages_permission($status);
        if($list_team > 0){
            $total_row = count($list_team_page);
            $num_page = ceil($total_row / $num_per_page);
            $list_team = get_team_page($start, $num_per_page, "permission='{$status}'");
            $base_url = "?mod=users&controller=team&permission=$status";
        } else {
            $error['error'] = "Không có bản ghi";
        }
    }
    if (isset($_POST['btn_search'])) {
        if (empty($_POST['key'])) {
            $error['key'] = "Vui lòng nhập từ khoá tìm kiếm";
        } else {
            $search = $_POST['key'];
            $list_search = search_str($search);
            if (!empty($list_search)) {
                $total_row = count($list_search);
            } else {
                $total_row = 0;
                $error['key'] = "Không có dữ liệu cần tìm";
            }
            $num_page = ceil($total_row / $num_per_page);
            $list_team = get_list_team_search_page($start, $num_per_page, $search);
            $base_url = "?mod=users&controller=team&key={$search}";
        }
    }
    if (isset($_GET['key']) && !isset($_POST['btn_search'])) {
        $search = $_GET['key'];
        $list_search = search_str($search);
        $total_row = count($list_search);
        $num_page = ceil($total_row / $num_per_page);
        $list_team = get_list_team_search_page($start, $num_per_page, $search);
        $base_url = "?mod=users&controller=team&key={$search}";
    }
    if (isset($_POST['btn-action'])) {
        $str_check = "";
        if (empty($_POST['user_id'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['user_id']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'permission' => $action,
            );
            update_status($data, $str_check);
            if (!isset($_GET['page'])) {
                redirect("?mod=users&controller=team");
            } else if (isset($_GET['page'])) {
                redirect("?mod=users&controller=team&page=$page_current");
            }
        }
    }
    if($get_list_team > 0) {
        $count_all = count($get_list_team);
    }
    $data = array(
        'count_all' => $count_all,
        'count_system_admin' =>  $count_system_admin,
        'count_system_page' => $count_system_page,
        'count_system_post' => $count_system_post,
        'active' => $active,
        'page' => $page,
        'status' => $status,
        'start' => $start,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'num_per_page' => $num_per_page,
        'page_current' => $page_current,
        'list_team' => $list_team,
        'error' => $error
    );
    load_view('teamIndex', $data);
}

function delAction()
{
    $id_user = $_GET['users_id'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_users', "`user_id`='$id_user'");
    if(!isset($_GET['permission'])){
       redirect("?mod=users&controller=team&page=$page_current"); 
    } else{
        redirect("?mod=users&controller=team&action=del&users_id=$id_user&page_current=$page_current"); 
    }
    
}