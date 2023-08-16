<?php
function is_username($username){
    $pattern = "/^[A-Za-z0-9_\.]{3,32}$/";
    if(!preg_match($pattern,$username, $matchs))
        return FALSE;
    return TRUE;
}
function is_password($password){
    $pattern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,32}$/";
    if(!preg_match($pattern, $password, $matchs))
        return FALSE;
    return TRUE;
}
function is_phone($phone){
    $pattern = "/^(03|09|08|01[2|6|8|9])+([0-9]{8})$/";
    if(!preg_match($pattern, $phone, $matchs))
        return FALSE;
    return TRUE;
}
function is_email($email){
    $pattern = "/^[A-Za-z0-9_\.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if(!preg_match($pattern,$email)){
        return false;
    }
    return true;
}
function is_slug($slug){
    $pattern = "/^([a-zA-Z0-9_-]+)$/";
    if(!preg_match($pattern,$slug)){
        return false;
    }
    return true;
}

// function is_email($email){
//     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//         return false;
//     }
//     return true;
// }

function form_error($label_field){
    global $error;
    if(!empty($error[$label_field])) return "<p class='error'>{$error[$label_field]}</p>";
}

function set_value($label_field){
    global $$label_field;
    if(!empty($$label_field)) return $$label_field;
}

?>
