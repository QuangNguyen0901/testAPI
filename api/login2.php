<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');
include($root . '/libs/hash.php');
$hash = new Hash();


if (!empty(file_get_contents('php://input'))) {
    $post = json_decode(file_get_contents('php://input'), true);
    $user_name = '';
    $pass = '';
    $success = true;

    if (!$post['user'] || $post['user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input username';
        $success = false;
    } else $user_name = $post['user'];

    if (!$post['pass'] || $post['pass'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input password';
        $success = false;
    } else $pass = $post['pass'];

    if ($success) {
        $db = new MysqliDb();
        $flash = NULL;

        //Convert input pass to salt(chuoi ma hoa)
        $db->where("user_name", $user_name);
        $cols = Array('salt');
        $salt = $db->getOne('member', null, $cols)['salt'];
        $pass = $hash->create($pass, $salt);

        //Select user voi ten user va pass ma hoa da nhap
        $db->where("user_name", $user_name);
        $db->where("password", $pass);
        $user = $db->getOne('member');

        if ($db->count == 1) {
            $token = $hash->random();
            $date = date('Y/m/d H:i:s');
//            echo $token;

            $data = array(
                "token" => $token,
                "token_started_at" => $date
            );

//          insert token vaof DB
            $db->where('id', $user['id']);
            $db->update('member', $data);
//          Lay lai user da cap nhan token
            $db->where("user_name", $user_name);
            $db->where("password", $pass);
            $user = $db->getOne('member');

            $xml_root_tag = '<user></user>';
            $result = $user;
            include($root . '/libs/convert_format.php');
            exit;
        } else {
            echo 'login that bai';
            exit;
        }
    } else {
        echo 'login that bai';
        exit;
    }
} else {
    echo 'Khong co thong tin GET';
}