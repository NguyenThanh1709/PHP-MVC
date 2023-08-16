<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    global $base_url;
    $list_product = get_list_product();
    $count_all_products = count_all_product();
    $count_publish = count_product_publish();
    $count_pending = count_product_pending();
    $count_trash = count_product_trash();
    $error = array();
    $num_per_page = 20;
    $total_row = count($list_product);
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page_current = $page;
    $start = ($page - 1) * $num_per_page;
    $list_products_page = get_products_page($start, $num_per_page,);
    $base_url = "?mod=products";
    $status = "";
    if (!isset($_GET['status']) && !isset($_POST['btn_search']) && !isset($_POST['btn_search'])) {
        $list_products_page = get_products_page($start, $num_per_page,);
        $base_url = "?mod=products";
    }
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $list_pages_status = get_list_pages_status($status);
        $total_row = count($list_pages_status);
        $num_page = ceil($total_row / $num_per_page);
        $list_products_page = get_products_page($start, $num_per_page, "product_status='{$status}'");
        $base_url = "?mod=products&status=$status";
    }
    if (isset($_POST['btn_search'])) {
        if (empty($_POST['key'])) {
            $error['key'] = "Vui lòng nhập từ khoá tìm kiếm";
        } else {
            $search = $_POST['key'];
            $list_search = search_str($search);
            if (!empty($list_search)) {
                $total_row = count($list_search);
                $num_page = ceil($total_row / $num_per_page);
                $list_products_page = get_list_product_search_page($start, $num_per_page, $search);
                $base_url = "?mod=products&key={$search}";
            } else {
                $error['key'] = "Không có dữ liệu cần tìm";
            }
        }
    }
    if (isset($_GET['key']) && !isset($_POST['btn_search'])) {
        $search = $_GET['key'];
        $list_search = search_str($search);
        $total_row = count($list_search);
        $num_page = ceil($total_row / $num_per_page);
        $list_products_page = get_list_product_search_page($start, $num_per_page, $search);
        $base_url = "?mod=products&key={$search}";
    }
    if (isset($_POST['btn-action'])) {
        $str_check = "";
        if (empty($_POST['product_id'])) {
            $error['actions'] = "Vui lòng chọn đối tượng để thao tác!";
        } else {
            $str_check = implode(',', $_POST['product_id']);
        }
        if (empty($_POST['actions'])) {
            $error['actions'] = "Vui lòng chọn tác vụ!";
        } else {
            $action = $_POST['actions'];
        }
        if (empty($error)) {
            $data = array(
                'product_status' => $action,
            );
            update_status($data, $str_check);
            if (!isset($_GET['page'])) {
                redirect("?mod=products");
            } else if (isset($_GET['page'])) {
                redirect("?mod=products&page=$page_current");
            }
        }
    }

    $data = array(
        'start' => $start,
        'status' => $status,
        'error' => $error,
        'page' => $page,
        'base_url' => $base_url,
        'num_page' => $num_page,
        'page_current' => $page_current,
        'list_products_page' => $list_products_page,
        'count_all_products' => $count_all_products,
        'count_publish' => $count_publish,
        'count_pending' => $count_pending,
        'count_trash' => $count_trash,
    );
    load_view('index', $data);
}

function addAction()
{
    global $url_images, $succes_insert, $error, $product_name, $parent_id, $status,$price,$desc, $detai_product,$trademark,$number_product;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    $cat_name = "";
    $source = get_list_product_cat();
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
    $list_product_cat = data_tree2($source, 0, 0);
    if (isset($_POST['btn_add'])) {
        // print_r($_POST);
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Vui lòng chọn danh mục cha";
        } else {
            $parent_id = $_POST['parent_id'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái";
        } else {
            $status = $_POST['status'];
        }
        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }
        if (empty($_POST['desc'])) {
            $error['desc'] = "Nhập mô tả ngắn của sản phẩm";
        } else {
            $desc = $_POST['desc'];
        }
        if (empty($_POST['detai_product'])) {
            $error['detai_product'] = "Nhập mô tả chi tiết sản phẩm";
        } else {
            $detai_product = $_POST['detai_product'];
        }
        if (empty($_POST['trademark'])) {
            $error['trademark'] = "Không được để trống tên thương hiệu";
        } else {
            $trademark = $_POST['trademark'];
        }
        if (empty($_POST['number_product'])) {
            $error['number_product'] = "Không được để trống số lượng sản phẩm";
        } else {
            $number_product = $_POST['number_product'];
        }
        if (empty($_POST['sale_off']) || $_POST['sale_off'] == 0) {
            $sale_off = $_POST['price'];
        } else {
            $sale_off = $_POST['sale_off'];
        }
        if (isset($sale_off) && isset($price)) {
            $discount = round((($price - $sale_off) / $price) * 100);
        }
        if (!empty($product_name)) {
            $slug = create_slug($product_name);
        }
        if (isset($_FILES['file'])) {
            $name = $_FILES['file']['name'];
            $tmp_name = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $upload_dir = 'public/uploads/';
            // Xử lý upload đúng file ảnh
            $type_allow = array('png', 'jpg', 'gif', 'jpeg', 'webp');
            for ($i = 0; $i < count($name); $i++) {
                $upload_file = $upload_dir . $name[$i];
                $type = pathinfo($name[$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($name[$i], PATHINFO_FILENAME);
                if (!in_array(strtolower($type), $type_allow)) {
                    $error['file'] = "Chỉ được upload file ảnh có đuôi pn, jpg, gif, jpeg, webp";
                } else {
                    // Upload file có kích thước cho phép (<20MB)
                    $file_size = $size[$i];
                    // echo "{$file_size}.<br>";
                    if ($file_size > 21000000) {
                        $error['file'] = "chỉ được upload file bé hơn 20MB";
                    }
                    // Kiểm tra trùng file trên hệ thống
                    if (file_exists($upload_file)) {
                        //----------------
                        //Xử lý đổi tên file tự động
                        //----------------
                        #tạo file mới
                        //Tên file.đuôi file
                        $file_name = pathinfo($name[$i], PATHINFO_FILENAME);
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
                        // echo $file_name;
                        // $error['file_exists'] = "File đã tồn tại trên hệ thống";
                    }
                }
                if ($upload_file == $upload_dir) {
                    $url_images .= "";
                } else if (move_uploaded_file($tmp_name[$i], $upload_file)) {
                    $url_images .= ",{$upload_file}";
                } else {
                    $error['file'] = "upload file không thành công";
                }
            }
            $num = strpos($url_images, ",");
            if ($num == 0) {
                $url_images = ltrim($url_images, ",");
            }
        }

        if (empty($error)) {
            $data = array(
                'product_name' => $product_name,
                // 'product_code' => $product_code,
                'slug' => $slug,
                'product_price' => $price,
                'product_desc' => $desc,
                'content' => $detai_product,
                'trademark' => $trademark,
                'url_images' => $url_images,
                'cat_id' => $parent_id,
                'user_id' => $info_user['user_id'],
                'created_date' => date("d/m/y h:m:s"),
                'product_status' => $status,
                'discount' => $discount,
                'sale_off' => $sale_off,
                'num_add_cart' => $number_product,
                'num_check_out' => 0,
            );
            // show_array($data);
            $insert = db_insert('`tbl_products`', $data);
            if ($insert) {
                $_SESSION['success'] = "Thông báo: Thêm sản phẩm mới thành công";
                redirect("?mod=products");
            } else {
            }
        }
    }
    $data = array(
        'succes_insert' => $succes_insert,
        'list_product_cat' => $list_product_cat,
        'cat_name' => $cat_name,
        'error' => $error
    );

    load_view('add', $data);
}

function infoProductAction()
{
    global $update_status;
    $error = array();
    $url_images = "";
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $getProductById = get_product_by_id($product_id);
        $list_images = explode(",", $getProductById['url_images']);
    }
    $source = get_list_product_cat();
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
    $list_product_cat = data_tree3($source, 0, 0);
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Vui lòng chọn danh mục cha";
        } else {
            $parent_id = $_POST['parent_id'];
        }
        if (empty($_POST['status'])) {
            $error['status'] = "Vui lòng chọn trạng thái";
        } else {
            $status = $_POST['status'];
        }
        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }
        if (empty($_POST['desc'])) {
            $error['desc'] = "Nhập mô tả sản phẩm";
        } else {
            $desc = $_POST['desc'];
        }
        if (empty($_POST['detai_product'])) {
            $error['detai_product'] = "Nhập mô tả sản phẩm";
        } else {
            $detai_product = $_POST['detai_product'];
        }
        if (empty($_POST['trademark'])) {
            $error['trademark'] = "Không được để trống tên thương hiệu";
        } else {
            $trademark = $_POST['trademark'];
        }
        if (empty($_POST['number_product'])) {
            $error['number_product'] = "Không được để trống tên thương hiệu";
        } else {
            $number_product = $_POST['number_product'];
        }
        if(empty($_POST['sale_off'])) {
            $error['number_product'] = "Vui lòng điền giá giảm";
        } else {
            $sale_off = $_POST['sale_off'];
        }
        if (isset($sale_off)) {
            $discount = round((($price - $sale_off) / $price) * 100);
        }
        if (!empty($product_name)) {
            $slug = create_slug($product_name);
        }
        if ($_FILES["file"]["error"] > 0) {
            $data = array(
                'product_name' => $product_name,
                // 'product_code' => $product_code,
                'slug' => $slug,
                'product_price' => $price,
                'product_desc' => $desc,
                'content' => $detai_product,
                'trademark' => $trademark,
                'cat_id' => $parent_id,
                'product_status' => $status,
                'num_add_cart' => $number_product,
                'sale_off' => $sale_off,
                'discount' => $discount
            );
            $update = db_update('tbl_products', $data, "`product_id`='$product_id'");
            if ($update) {
                $update_status = true;
            }
        }
        if (isset($_FILES['file'])) {
            $name = $_FILES['file']['name'];
            $tmp_name = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $upload_dir = 'public/uploads/';
            // Xử lý upload đúng file ảnh
            $type_allow = array('png', 'jpg', 'gif', 'jpeg', 'webp');
            for ($i = 0; $i < count($name); $i++) {
                $upload_file = $upload_dir . $name[$i];
                $type = pathinfo($name[$i], PATHINFO_EXTENSION);
                $file_name = pathinfo($name[$i], PATHINFO_FILENAME);
                if (!in_array(strtolower($type), $type_allow)) {
                    $error['file'] = "Chỉ được upload file ảnh có đuôi pn, jpg, gif, jpeg, webp";
                } else {
                    // Upload file có kích thước cho phép (<20MB)
                    $file_size = $size[$i];
                    // echo "{$file_size}.<br>";
                    if ($file_size > 21000000) {
                        $error['file'] = "chỉ được upload file bé hơn 20MB";
                    }
                    // Kiểm tra trùng file trên hệ thống
                    if (file_exists($upload_file)) {
                        //----------------
                        //Xử lý đổi tên file tự động
                        //----------------
                        #tạo file mới
                        //Tên file.đuôi file
                        $file_name = pathinfo($name[$i], PATHINFO_FILENAME);
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
                        // echo $file_name;
                        // $error['file_exists'] = "File đã tồn tại trên hệ thống";
                    }
                }
                if ($upload_file == $upload_dir) {
                    $url_images .= "";
                } else if (move_uploaded_file($tmp_name[$i], $upload_file)) {
                    $url_images .= ",{$upload_file}";
                } else {
                    $error['file'] = "upload file không thành công";
                }
            }
            $num = strpos($url_images, ",");
            if ($num == 0) {
                $url_images = ltrim($url_images, ",");
            }
        }
        if (empty($error)) {
            $data = array(
                'product_name' => $product_name,
                // 'product_code' => $product_code,
                'slug' => $slug,
                'product_price' => $price,
                'product_desc' => $desc,
                'content' => $detai_product,
                'trademark' => $trademark,
                'url_images' => $url_images,
                'cat_id' => $parent_id,
                'product_status' => $status,
                'num_add_cart' => $number_product,
                'sale_off' => $sale_off,
                'discount' => $discount
            );
            $update = db_update('tbl_products', $data, "`product_id`='$product_id'");
            if ($update) {
                $update_status = true;
            } else {
                // print_r($error);
            }
        }
    }
    $data = array(
        'update_status' => $update_status,
        'list_product_cat' => $list_product_cat,
        'product_id' => $product_id,
        'getProductById' => $getProductById,
        'list_images' => $list_images
    );
    load_view('infoProduct', $data);
}

function deleteAction()
{
    $id_product = $_GET['product_id'];
    $page_current = $_GET['page_current'];
    db_delete('tbl_products', "`product_id`='$id_product'");
    redirect("?mod=products&page=$page_current");
}
