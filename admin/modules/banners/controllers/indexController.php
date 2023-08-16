<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $error, $search;
    $count_all = count_all_banner();
    $count_pending = count_banner_pending();
    $count_publish = count_banner_publish();
    $count_trash = count_banner_trash();
    $listbanners = get_list_banners();
    $num_per_page = 30;
    $total_row = count($listbanners);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_banner = get_banners_pages($start, $num_per_page,);
    $base_url = "?mod=banners";
    $status = "";
    if (!isset($_GET['status']) && !isset($_POST['btn_search']) && !isset($_POST['btn_search'])) {
        $list_banner = get_banners_pages($start, $num_per_page,);
        $base_url = "?mod=banners";
    }
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_pages_status = get_list_banners_status($status);
        $total_row = count($list_pages_status);
        $num_page = ceil($total_row / $num_per_page);
        $list_banner = get_banners_pages($start, $num_per_page, "status='{$status}'");
        $base_url = "?mod=banners&status=$status";
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
            $list_banner = get_list_banner_search_page($start, $num_per_page, $search);
            $base_url = "?mod=banners&key={$search}";
        }
    }
    if (isset($_GET['key']) && !isset($_POST['btn_search'])) {
        $search = $_GET['key'];
        $list_search = search_str($search);
        $total_row = count($list_search);
        $num_page = ceil($total_row / $num_per_page);
        $list_banner = get_list_banner_search_page($start, $num_per_page, $search);
        $base_url = "?mod=banners&key={$search}";
    }
    if (isset($_POST['btn-action'])) {
        $str_check = "";
        if (empty($_POST['banner_id'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['banner_id']);
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
                redirect("?mod=banners");
            } else if (isset($_GET['page'])) {
                redirect("?mod=banners&page=$page_current");
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
        'list_banner' => $list_banner
    );
    load_view('index', $data);
}

function addAction()
{
    global $img, $insert_success, $error, $banner_name, $status, $link_url;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    if (isset($_POST['btn_add'])) {
        // print_r($_POST);
        // show_array($_POST);
        $alert = array();
        $error = array();
        if (empty($_POST['banner_name'])) {
            $error['banner_name'] = "Không được để trống tên banner";
        } else {
            $banner_name = $_POST['banner_name'];
        }
        if (empty($_POST['link-url'])) {
            $error['link-url'] = "Vui lòng điền đường dẫn liên kết";
        } else {
            $link_url = $_POST['link-url'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn banner";
        } else {
            $status = $_POST['status'];
        }
        if (isset($_FILES['file'])) {
            $upload_dir = 'public/uploads/'; //Đường dẫn của file sau khi upload                
            $upload_file = $upload_dir . $_FILES['file']['name']; // Xử lý upload đúng file ảnh           
            $type_allow = array('png', 'jpg', 'gif', 'jpeg', 'webp');
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) { //Kiểm tra nếu không là file ảnh
                $error['file'] = "Chỉ được upload file ảnh có đuôi png, jpg, gif, jpeg, webp";
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
                'banner_name' => $banner_name,
                'status' => $status,
                'url_images' => $img,
                'user_id' => $info_user['user_id'],
                'link_url' => $link_url,
                'created_date' => date("d/m/y h:m:s"),
            );
            $insert_success = db_insert('tbl_banners', $data);
            if ($insert_success) {
                $_SESSION['success'] = "Thông báo: Thêm banner mới thành công";
                redirect("?mod=banners");
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
    global $img, $success, $error, $link_url;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    $banner_id = $_GET['banner_id'];
    $info_banner = get_info_banner($banner_id);
    if (isset($_POST['btn_update'])) {
        $alert = array();
        $error = array();
        if (empty($_POST['banner_name'])) {
            $error['banner_name'] = "Không được để trống tên banner";
        } else {
            $banner_name = $_POST['banner_name'];
        }
        if (empty($_POST['link-url'])) {
            $error['link-url'] = "Vui lòng điền đường dẫn liên kết";
        } else {
            $link_url = $_POST['link-url'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái";
        } else {
            $status = $_POST['status'];
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
                    'banner_name' => $banner_name,
                    'status' => $status,
                    'link_url' => $link_url
                );
            } else {
                $data = array(
                    'banner_name' => $banner_name,
                    'status' => $status,
                    'url_images' => $img,
                    'link_url' => $link_url
                );
            }
            $update_success = db_update('tbl_banners', $data, "`banner_id`='$banner_id'");
            if ($update_success) {
                $success = true;
            }
        }
    }
    $data = array(
        'error' => $error,
        'info_banner' => $info_banner,
        'success' => $success
    );
    load_view('update', $data);
}

function delAction()
{
    $id_banner = $_GET['banner_id'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_banners', "`banner_id`='$id_banner'");
    redirect("?mod=banners&page=$page_current");
}
