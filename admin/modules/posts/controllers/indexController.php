<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $status, $error;
    $listPost = get_list_post();
    $countAll = count_all_post();
    $count_publish = count_post_publish();
    $count_pending = count_post_pending();
    $count_trash = count_post_trash();
    $num_per_page = 8;
    $total_row = count($listPost);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_post_page = get_post_page($start, $num_per_page,);
    $base_url = "?mod=posts";
    if (!isset($_GET['status']) && !isset($_POST['btn_search']) && !isset($_POST['action'])) {
        $list_post_page = get_post_page($start, $num_per_page,);
        $base_url = "?mod=posts";
    }
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_post_status = get_list_post_status($status);
        $total_row = count($list_post_status);
        $num_page = ceil($total_row / $num_per_page);
        $list_post_page = get_post_page($start, $num_per_page, "post_status='{$status}'");
        $base_url = "?mod=posts&status=$status";
    }
    if (isset($_POST['btn_search'])) {
        if (empty($_POST['key'])) {
            $error['key'] = "Vui lòng nhập từ khoá tìm kiếm";
        } else {
            $search = $_POST['key'];
            $list_search = search_str($search);
            $total_row = count($list_search);
            $num_page = ceil($total_row / $num_per_page);
            $list_post_page = get_list_post_search_page($start, $num_per_page, $search);
            $base_url = "?mod=posts&key={$search}";
        }
        if ($total_row == 0) {
            $error['key'] = "Không có dữ liệu cần tìm";
        }
    }
    if (isset($_GET['key']) && !isset($_POST['btn_search'])) {
        $search = $_GET['key'];
        $list_search = search_str($search);
        $total_row = count($list_search);
        $num_page = ceil($total_row / $num_per_page);
        $list_post_page = get_list_post_search_page($start, $num_per_page, $search);
        $base_url = "?mod=posts&key={$search}";
    }
    if (isset($_POST['btn-action'])) {
        $str_check = "";
        if (empty($_POST['post_id'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['post_id']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'post_status' => $action,
            );
            update_status($data, $str_check);
            if (!isset($_GET['page'])) {
                redirect("?mod=posts");
            } else if (isset($_GET['page'])) {
                redirect("?mod=posts&page=$page_current");
            }
        }
    }
    $data = array(
        'error' => $error,
        'status' => $status,
        'countAll' => $countAll,
        'count_publish' => $count_publish,
        'count_pending' => $count_pending,
        'count_trash' => $count_trash,
        'page' => $page,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'page_current' => $page_current,
        'list_post_page' => $list_post_page,
    );
    load_view('index', $data);
}

function addAction()
{
    global $insert_success, $error, $post_id, $post_name, $category, $content, $status;
    $error = array();
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    if (isset($_POST['btn_add'])) {
        if (empty($_POST['post_id'])) {
            $error['post_id'] = "Vui lòng điền mã bài viết";
        } else {
            $post_id = $_POST['post_id'];
        }
        if (empty($_POST['post_name'])) {
            $error['post_name'] = "Vui lòng điền tên tiêu đề bài viết";
        } else {
            $post_name = $_POST['post_name'];
        }
        if (empty($_POST['category'])) {
            $error['category'] = "Vui lòng chọn chuyên mục bài viết";
        } else {
            $category = $_POST['category'];
        }
        if (empty($_POST['content'])) {
            $error['content'] = "Vui lòng điền nội dung bài viết";
        } else {
            $content = $_POST['content'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái bài viết";
        } else {
            $status = $_POST['status'];
        }
        if (isset($post_name)) {
            $slug = create_slug($post_name);
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
                'post_id' => $post_id,
                'post_title' => $post_name,
                'category' => $category,
                'content' => $content,
                'post_status' => $status,
                'url_images' => $img,
                'slug' => $slug,
                'user_id' => $info_user['user_id'],
                'created_date' => date("d/m/y h:m:s"),
            );
            $insert = db_insert('tbl_post', $data);
            if ($insert) {
                $_SESSION['success'] = "Thông báo: Đã thêm bài viết mới thành công";
                redirect("?mod=posts");
            }
        }
    }
    $data = array(
        'insert_success' => $insert_success,
        'error' => $error
    );
    load_view('add', $data);
}

function updateAction()
{
    global $update_success;
    $post_id = $_GET['post_id'];
    $infoPost = get_info_post($post_id);
    if (isset($_POST['btn_update'])) {
        if (empty($_POST['post_name'])) {
            $error['post_name'] = "Vui lòng điền tên tiêu đề bài viết";
        } else {
            $post_name = $_POST['post_name'];
        }
        if (empty($_POST['category'])) {
            $error['category'] = "Vui lòng chọn chuyên mục bài viết";
        } else {
            $category = $_POST['category'];
        }
        if (empty($_POST['content'])) {
            $error['content'] = "Vui lòng điền nội dung bài viết";
        } else {
            $content = $_POST['content'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái bài viết";
        } else {
            $status = $_POST['status'];
        }
        if (isset($post_name)) {
            $slug = create_slug($post_name);
        }
        if ($_FILES["file"]["error"] > 0) {
        } else if (isset($_FILES['file'])) {
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
            if ($_FILES["file"]["error"] > 0) {
                $data = array(
                    'post_title' => $post_name,
                    'category' => $category,
                    'content' => $content,
                    'post_status' => $status,
                    'slug' => $slug,
                    'created_date' => date("d/m/y h:m:s"),
                );
            } else {
                $data = array(
                    'post_title' => $post_name,
                    'category' => $category,
                    'content' => $content,
                    'post_status' => $status,
                    'url_images' => $img,
                    'slug' => $slug,
                    'created_date' => date("d/m/y h:m:s"),
                );
            }
            $update = db_update('tbl_post', $data, "`post_id` = '$post_id'");
            if ($update) {
                $update_success = true;
            }
        }
    }
    $data = array(
        'update_success' => $update_success,
        'infoPost' => $infoPost
    );
    load_view('update', $data);
}

function delAction()
{
    $post_id = $_GET['post_id'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_post', "`post_id` = '$post_id'");
    redirect("?mod=posts&page=$page_current");
}
