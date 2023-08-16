<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

function loginAction()
{
    global $error, $username, $password, $fullname;
    if (isset($_POST['btn_login'])) {
        $error = array();
        //check username
        if (empty($_POST['username'])) {
            $error['username'] = "Không để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        //check password
        if (empty($_POST['password'])) {
            $error['password'] = "Không để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        //Kết luận
        if (empty($error)) {
            if (!check_login($username, $password)) {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
            } else {
                $data = array(
                    'user_status' => "online"
                );
                //Update trạng thái đăng nhập
                db_update('tbl_users', $data, "`username`='$username'");
                //lưu trữ phiên đăng nhập
                $_SESSION['fullname'] = get_fullname_login($username, $password);
                //echo $_SESSION['fullname'];
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                //Chuyển hướng tới hệ thống
                redirect();
            }
        }
    }
    load_view('login');
}

function logoutAction()
{
    $username = $_SESSION['user_login'];
    $data = array(
        'user_status' => "offline"
    );
    db_update('tbl_users', $data, "`username`='$username'");
    unset($_SESSION['user_login']);
    unset($_SESSION['is_login']);
}

function addAction()
{
    global $succes_insert, $error,  $active;
    $active = $_GET['action'];
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);

    if (isset($_POST['btn_addAccount'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Vui lòng nhập họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }

        if (empty($_POST['username'])) {
            $error['username'] = "Vui lòng nhập tên tài khoản";
        } else if (!is_username($_POST['username'])) {
            $error['username'] = "Vui lòng nhập tên tài khoản đúng định dạng";
        } else {
            $username = $_POST['username'];
        }

        if (empty($_POST['permission'])) {
            $error['permission'] = "Vui lòng chọn phân quyền";
        } else {
            $permission = $_POST['permission'];
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Vui lòng nhập mật khẩu";
        } else if (!is_password($_POST['password'])) {
            $error['password'] = "Vui lòng nhập mật khẩu đúng định dạng";
        } else {
            $password = md5($_POST['password']);
        }

        if (empty($_POST['phone_number'])) {
            $error['phone'] = "Vui lòng nhập số điện thoai";
        } else if (!is_phone($_POST['phone_number'])) {
            $error['phone'] = "Vui lòng nhập số điện thoai đúng định dạng";
        } else {
            $phone = $_POST['phone_number'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Vui lòng nhập email";
        } else if (!is_email($_POST['email'])) {
            $error['email'] = "Vui lòng nhập email đúng định dạng";
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Vui lòng nhập địa chỉ";
        } else {
            $address = $_POST['address'];
        }

        if (empty($error)) {
            $data = array(
                'phone_number' => $phone,
                'fullname' => $fullname,
                'address' => $address,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'permission' => $permission,
                'user_created' => $info_user['fullname'],
                'created_date' => date("d/m/y h:m:s"),
                'user_status' => 'offline'
            );
            $insert = db_insert('tbl_users', $data);
            if ($insert) {
                $_SESSION['success'] = "Thông báo: Đã thêm tài khoản người dùng mới thành công";
            }
            redirect('?mod=users&controller=team');
        }
    }
    $data = array(
        'info_user' => $info_user,
        'succes_insert' => $succes_insert,
        'active' => $active,
        'error' => $error
    );
    load_view('add', $data);
}

function editAction()
{
    global $succes_update, $active, $error;
    $username = $_SESSION['user_login'];
    if (isset($_GET['users_id'])) {
        $user_id = $_GET['users_id'];
        $info_user = get_info_user_team($user_id);
    } else {
        $info_user = get_info_user($username);
    }
    $active = $_GET['action'];

    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['display-name'])) {
            $error['display-name'] = "Vui lòng nhập họ và tên";
        } else {
            $fullname = $_POST['display-name'];
        }
        if (empty($_POST['tel'])) {
            $error['tel'] = "Vui lòng nhập số điện thoại";
        } else if (!is_phone($_POST['tel'])) {
            $error['tel'] = "Vui lòng nhập số điện thoại đúng định dạng";
        } else {
            $phone = $_POST['tel'];
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Vui lòng nhập địa chỉ";
        } else {
            $address = $_POST['address'];
        }
        if (empty($error)) {
            $data = array(
                'phone_number' => $phone,
                'fullname' => $fullname,
                'address' => $address
            );
            if (isset($_GET['users_id'])) {
                $update = db_update('tbl_users', $data, "`user_id`='$user_id'");
            } else {
                $update = db_update('tbl_users', $data, "`username`='$username'");
            }
            if ($update) {
                $succes_update = true;
            }
        }
    }
    $data = array(
        'active' => $active,
        'info_user' => $info_user,
        'succes_update' => $succes_update,
        'error' => $error
    );
    // print_r($info_user);
    load_view('info', $data);
}

function changepwAction()
{
    global $error, $update_success, $alert;
    $username = $_SESSION['user_login'];
    $info_user = get_info_user($username);
    if (isset($_POST['btn_update'])) {
        $error = array();
        $alert = array();
        if (empty($_POST['pass-old'])) {
            $error['pass-old'] = "Vui lòng nhập mật khẩu cũ!";
        } else if (md5($_POST['pass-old']) != $info_user['password']) {
            $error['pass-old'] = "Mật khẩu cũ không đúng! vui lòng thử lại.";
        } else {
            $passOld = $_POST['pass-old'];
        }
        if (empty($_POST['pass-new'])) {
            $error['pass-new'] = "Vui lòng nhập mật khẩu mới!";
        } else if (!is_password($_POST['pass-new'])) {
            $error['pass-new'] = "Vui lòng nhập mật khẩu đúng định dạng";
        }
        if (empty($_POST['confirm-pass'])) {
            $error['confirm-pass'] = "Vui lòng nhập lại mật khẩu mới!";
        } else if (!is_password($_POST['confirm-pass'])) {
            $error['confirm-pass'] = "Vui lòng nhập mật khẩu đúng định dạng";
        } else if ($_POST['confirm-pass'] == $_POST['pass-new']) {
            $password = md5($_POST['confirm-pass']);
        } else {
            $error['changepw'] = "Nhập lại mật khẩu mới không chính xác!";
        }
        if (empty($error)) {
            $data = array(
                'password' => $password,
            );
            $update = db_update('tbl_users', $data, "`username` ='$username'");
            if ($update) {
                $alert['success'] = "Mật khẩu đã được thay đổi!";
            }
        }
    }
    $data = array(
        'alert' => $alert,
        'error' => $error,
        'update_success' => $update_success,
    );
    load_view('changepw', $data);
}

function resetAction()
{
    global $error, $email, $reset_token, $password, $alert;
    if (isset($_GET['reset_token'])) {
        $reset_token = $_GET['reset_token'];
        if (!empty($reset_token)) {
            if (check_reset_token($reset_token)) {
                if (isset($_POST['btn_reset_pass'])) {
                    $error = array();
                    $alert = array();
                    if (empty($_POST['password-new'])) {
                        $error['password-new'] = "Vui lòng nhập mật khẩu mới!";
                    } else if (!is_password($_POST['password-new'])) {
                        $error['password-new'] = "Vui lòng nhập mật khẩu đúng định dạng";
                    }
                    if (empty($_POST['confirm-pw-new'])) {
                        $error['confirm-pw-new'] = "Vui lòng nhập lại mật khẩu mới!";
                    } else if (!is_password($_POST['confirm-pw-new'])) {
                        $error['confirm-pw-new'] = "Vui lòng nhập mật khẩu đúng định dạng";
                    } else if ($_POST['confirm-pw-new'] == $_POST['password-new']) {
                        $password = md5($_POST['confirm-pw-new']);
                    } else {
                        $error['changepw'] = "Nhập lại mật khẩu mới không chính xác!";
                    }
                    if (empty($error)) {
                        $data = array(
                            'password' => $password
                        );
                        update_password($data, $reset_token);
                        $alert['changpw'] = "Thay đổi mật khẩu thành công";
                    }
                }
                $data = array(
                    'alert' => $alert,
                );
                load_view('newPass', $data);
            } else {
                $error['email'] = "Yêu cầu khôi phục mật khẩu không hợp lệ";
            }
        }
    } else {
        //Kiểm tra email
        if (isset($_POST['btn_email'])) {
            $error = array();
            $alert = array();
            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else if (!is_email($_POST['email'])) {
                $error['email'] = "Vui lòng nhập email đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
            //Kết luận
            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $data = array(
                        'reset' => $reset_token,
                    );
                    update_reset_token($data, $email);
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = "<p>Click vào link dưới đây để khôi phục mật khẩu: {$link}</p>";
                    send_mail($email, 'Hệ thống quản lý bán hàng', 'Khôi phục mật khậu - Hệ thống quản lý bán hàng', $content);
                    $alert['send_mail'] = "Đã gửi thông báo vào email của bạn!";
                } else {
                    $error['email'] = "Không tồn tại email này trên hệ thống!";
                }
            }
        }
        $data = array(
            'alert' => $alert,
            'error' => $error,
        );
        load_view('reset', $data);
    }
}
