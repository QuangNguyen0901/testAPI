<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');

if (!empty($_GET)) {
    $user_name = '';
    $token = '';
    $success = true;

    if (!$_GET['user'] || $_GET['user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input username';
        $success = false;
    } else $user_name = $_GET['user'];

    if (!$_GET['token'] || $_GET['token'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input token';
        $success = false;
    } else $token = $_GET['token'];

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
            echo 'Khong co user tuong ung hoac co nhieu hon 1 user co thong tin dang nhap da nhap';
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
