<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');

if (!empty(file_get_contents('php://input'))) {
    $post = json_decode(file_get_contents('php://input'), true);
    $user_name = '';
    $token = '';
    $success = true;

    if (!$post['user'] || $post['user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input username';
        $success = false;
    } else $user_name = $post['user'];

    if (!$post['token'] || $post['token'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input token';
        $success = false;
    } else $token = $post['token'];

    if ($success) {
        $flash = NULL;
        $db = new MysqliDb();
        //select user
        $db->where("user_name", $user_name);
        $db->where("token", $token);
        $user = $db->get('member');
        if ($db->count == 1) {
            $date = date('Y/m/d H:i:s');
            $v = strtotime($date) - strtotime($user[0]['token_started_at']);
//            print_r($v);
            if ($v < 30) {
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
