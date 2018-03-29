<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');

if (!empty(file_get_contents('php://input'))) {
    $post = json_decode(file_get_contents('php://input'), true);
    $login_user_name = '';
    $token = '';
    $success = true;

    if (!isset($post['login_user']) || $post['login_user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input login_user';
        $success = false;
    } else $login_user_name = $post['login_user'];

    if (!isset($post['token']) || $post['token'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input token';
        $success = false;
    } else $token = $post['token'];

    if ($success) {
        $flash = NULL;
        $db = new MysqliDb();
        //select user
        $db->where("user_name", $login_user_name);
        $db->where("token", $token);
        $user = $db->get('member');
        if ($db->count == 1) {
            $date = date('Y/m/d H:i:s');
            $v = strtotime($date) - strtotime($user[0]['token_started_at']);
//            print_r($v);
            if ($v < LOGIN_TOKEN_TIME) {
                $result = $db->get('member');
                $xml_root_tag = '<users></users>'; //xml root tag
                include($root . '/libs/convert_format.php');
            }else {
                echo 'het han token.';
            }
        } else {
            echo 'login that bai';
            exit;
        }
    } else {
        echo 'login that bai';
        exit;
    }
} else {
    echo 'Khong co thong tin login';
}

////ket qua list member
//$db = new MysqliDb();
//$result = $db->get('member');
//
////xml root tag
//$xml_root_tag = '<users></users>';
//
//include($root . '/libs/convert_format.php');
