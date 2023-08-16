<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $noti;
    $today = date('Y/m/d');
    $list_order_new = get_list_order_new($today);
    $num_new_order = count_all_new_order($today);
    $num_new_order_processing = count_processing_new_order($today);
    $num_new_order_delivering = count_delivering_new_order($today);
    $num_new_order_delivered = count_delivered_new_order($today);
    $num_new_order_canceled = count_canceled_new_order($today);
    $total_price_order_success = sum_total_price_order_success();
    $num_success_order = count_order_success();
    $num_cenceled_order = count_order_cenceled();
    $num_processing = count_order_processing();
    $num_per_page = 15;
    $total_row = count($list_order_new);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_order_new_paging = get_order_new_paging($start, $num_per_page, $today,);
    $base_url = "?mod=home";
    $status = "";
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_status_order = get_status_new_order($today, $status);
        $total_row = count($list_status_order);
        $num_page = ceil($total_row / $num_per_page);
        $list_order_new_paging = get_order_new_paging($start, $num_per_page, $today, $status);
        $base_url = "?mod=home&status=$status";
    }
    if (isset($_POST['btn_action'])) {
        $str_check = "";
        if (empty($_POST['id_order'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['id_order']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'status' => $action,
            );
            update_status($data, $str_check);
            if (!isset($_GET['page'])) {
                redirect("?mod=home");
            } else if (isset($_GET['page'])) {
                redirect("?mod=home&page=$page_current");
            }
        }
    }
    if (isset($_POST['btn-update'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];
        $data = array(
            'status' => $status
        );
        redirect("?mod=home&action=index");
        update_status($data, $order_id);
        if (!isset($_GET['page'])) {
            redirect("?mod=home");
        } else if (isset($_GET['page'])) {
            redirect("?mod=home&page=$page_current");
        }
    }
    $data = array(
        'list_order_new_paging' => $list_order_new_paging,
        'num_new_order' => $num_new_order,
        'num_new_order_processing' => $num_new_order_processing,
        'num_new_order_delivering' => $num_new_order_delivering,
        'num_new_order_delivered' => $num_new_order_delivered,
        'num_new_order_canceled' => $num_new_order_canceled,
        'total_price_order_success' => $total_price_order_success,
        'page_current' => $page_current,
        'status' => $status,
        'num_processing' => $num_processing,
        'num_cenceled_order' => $num_cenceled_order,
        'num_success_order' => $num_success_order,
        'page' => $page,
        'num_page' => $num_page,
        'base_url' => $base_url,
        'noti' => $noti
    );
    load_view('index', $data);
}

function deleteAction()
{
    $id_order = $_GET['id_order'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_order', "`order_id`='$id_order'");
    redirect("?mod=home&page={$page_current}");
}

function detailAction()
{
    $today = date('Y/m/d');
    $id = $_POST['id'];
    $info_order_by_id_new = get_order_by_id($id, $today);
    $list_order_product_by_id_new = get_list_product_order_by_id($id);
    $name_district = get_name_district($info_order_by_id_new['maqh']);
    $name_province_city = get_name_province_city($info_order_by_id_new['matp']);
    $name_commune =  get_name_commune($info_order_by_id_new['xaid']);
    $data = array(
        'list_order_product_by_id_new' => $list_order_product_by_id_new,
        'info_order_by_id_new' => $info_order_by_id_new,
        'name_district' => $name_district,
        'name_province_city' => $name_province_city,
        'name_commune' => $name_commune
    );
    echo json_encode($data);
}
