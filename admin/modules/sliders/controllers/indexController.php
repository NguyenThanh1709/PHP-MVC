<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $error;
    $count_all = count_all_slider();
    $count_pending = count_slider_pending();
    $count_publish = count_slider_publish();
    $count_trash = count_slider_trash();
    $listSliders = get_list_sliders();
    $num_per_page = 30;
    $total_row = count($listSliders);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_slider = get_sliders_page($start, $num_per_page,);
    $base_url = "?mod=sliders";
    $status = "";
    if (!isset($_GET['status']) && !isset($_POST['btn_search']) && !isset($_POST['btn_search'])) {
        $list_slider = get_sliders_page($start, $num_per_page,);
        $base_url = "?mod=sliders";
    }
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_pages_status = get_list_pages_status($status);
        $total_row = count($list_pages_status);
        $num_page = ceil($total_row / $num_per_page);
        $list_slider = get_sliders_page($start, $num_per_page, "slider_status='{$status}'");
        $base_url = "?mod=sliders&status=$status";
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
            $list_slider = get_list_slider_search_page($start, $num_per_page, $search);
            $base_url = "?mod=sliders&key={$search}";
        }
    }
    if (isset($_GET['key']) && !isset($_POST['btn_search'])) {
        $search = $_GET['key'];
        $list_search = search_str($search);
        $total_row = count($list_search);
        $num_page = ceil($total_row / $num_per_page);
        $list_slider = get_list_slider_search_page($start, $num_per_page, $search);
        $base_url = "?mod=sliders&key={$search}";
    }
    if (isset($_POST['btn-action'])) {
        $str_check = "";
        if (empty($_POST['slider_id'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['slider_id']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'slider_status' => $action,
            );
            update_status($data, $str_check);
            if (!isset($_GET['page'])) {
                redirect("?mod=sliders");
            } else if (isset($_GET['page'])) {
                redirect("?mod=sliders&page=$page_current");
            }
        }
    }
    $data = array(
        'error' => $error,
        'page' => $page,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'start' => $start,
        'page_current' => $page_current,
        'count_all' => $count_all,
        'count_pending' => $count_pending,
        'count_publish' => $count_publish,
        'count_trash' => $count_trash,
        'list_slider' => $list_slider
    );
    load_view('index', $data);
}

function addAction()
{
    global $img, $insert_success, $error, $slider_name, $siler_status;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    if (isset($_POST['btn_add'])) {
        // print_r($_POST);
        $alert = array();
        $error = array();
        if (empty($_POST['slider_name'])) {
            $error['slider_name'] = "Không được để trống tên slider";
        } else {
            $slider_name = $_POST['slider_name'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn slider";
        } else {
            $siler_status = $_POST['status'];
        }
        if (isset($_FILES['file'])) {
            $upload_dir = 'public/uploads/'; //Đường dẫn của file sau khi upload                
            $upload_file = $upload_dir . $_FILES['file']['name']; // Xử lý upload đúng file ảnh           
            $type_allow = array('png', 'jpg', 'gif', 'jpeg');
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) { //Kiểm tra nếu không là file ảnh
                $error['file'] = "Chỉ được upload file ảnh có đuôi png, jpg, gif, jpeg";
            } else {
                $file_size = $_FILES['file']['size'];
                if ($file_size > 21000000) {
                    $error['file'] = "Chỉ được upload file nhỏ hơn 20MB";
                }
                // Kiểm tra trùng file trên hệ thống
                if (file_exists($upload_file)) {
                    //===========================
                    //Xử lý đổi tên file tự động=
                    //===========================
                    #Tạo file mới
                    //Tên file.đuôi file
                    $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                    $new_file_name = $file_name . ' - Copy.';
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                    $k = 1;
                    while (file_exists($new_upload_file)) {
                        $new_file_name = $file_name . " - Copy({$k}).";
                        $k++;
                        $new_upload_file = $upload_dir . $new_file_name . $type;
                    }
                    $upload_file = $new_upload_file;
                    $file_name = $new_file_name;
                }
            }
            if (empty($error['file'])) {
                if (move_uploaded_file(($_FILES['file']['tmp_name']), $upload_file)) {
                    $img = $upload_file;
                    // $success = true;
                } else {
                    // echo "Không thành công";
                }
            }
        }
        if (empty($error)) {
            $data = array(
                'slider_name' => $slider_name,
                'slider_status' => $siler_status,
                'url_images' => $img,
                'user_id' => $info_user['user_id'],
                'created_date' => date("d/m/y h:m:s"),
            );
            $insert_success = db_insert('tbl_sliders', $data);
            if ($insert_success) {
                $_SESSION['success'] = "Thông báo: Thêm dữ slider mới thành công";
                redirect("?mod=sliders");
            }
        }
    }
    $data = array(
        'insert_success' => $insert_success,
    );
    load_view('add', $data);
}

function updateAction()
{
    global $img, $success, $error;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    $slider_id = $_GET['slider_id'];
    $info_slider = get_info_slider($slider_id);
    if (isset($_POST['btn_update'])) {
        $alert = array();
        $error = array();
        if (empty($_POST['slider_name'])) {
            $error['slider_name'] = "Không được để trống tên slider";
        } else {
            $slider_name = $_POST['slider_name'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn slider";
        } else {
            $siler_status = $_POST['status'];
        }
        if ($_FILES["file"]["error"] > 0) {
        } else if (isset($_FILES['file'])) {
            $upload_dir = 'public/uploads/'; //Đường dẫn của file sau khi upload                
            $upload_file = $upload_dir . $_FILES['file']['name']; // Xử lý upload đúng file ảnh           
            $type_allow = array('png', 'jpg', 'gif', 'jpeg', 'webp');
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) { //Kiểm tra nếu không là file ảnh
                $error['file'] = "Chỉ được upload file ảnh có đuôi png, jpg, gif, jpeg";
            } else {
                $file_size = $_FILES['file']['size'];
                if ($file_size > 21000000) {
                    $error['file'] = "Chỉ được upload file nhỏ hơn 20MB";
                }
                // Kiểm tra trùng file trên hệ thống
                if (file_exists($upload_file)) {
                    //===========================
                    //Xử lý đổi tên file tự động=
                    //===========================
                    #Tạo file mới
                    //Tên file.đuôi file
                    $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                    $new_file_name = $file_name . ' - Copy.';
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                    $k = 1;
                    while (file_exists($new_upload_file)) {
                        $new_file_name = $file_name . " - Copy({$k}).";
                        $k++;
                        $new_upload_file = $upload_dir . $new_file_name . $type;
                    }
                    $upload_file = $new_upload_file;
                    $file_name = $new_file_name;
                }
            }
            if (empty($error['file'])) {
                if (move_uploaded_file(($_FILES['file']['tmp_name']), $upload_file)) {
                    $img = $upload_file;
                    // $success = true;
                } else {
                    // echo "Không thành công";
                }
            }
        }
        if (empty($error)) {
            if ($_FILES["file"]["error"] > 0) {
                $data = array(
                    'slider_name' => $slider_name,
                    'slider_status' => $siler_status,
                );
            } else {
                $data = array(
                    'slider_name' => $slider_name,
                    'slider_status' => $siler_status,
                    'url_images' => $img,
                );
            }
            $update_success = db_update('tbl_sliders', $data, "`slider_id`='$slider_id'");
            if ($update_success) {
                $success = true;
            }
        }
    }
    $data = array(
        'error' => $error,
        'info_slider' => $info_slider,
        'success' => $success
    );
    load_view('update', $data);
}

function delAction()
{
    $id_slider = $_GET['slider_id'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_sliders', "`slider_id`='$id_slider'");
    redirect("?mod=sliders&page=$page_current");
}
