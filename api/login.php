<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');
include($root . '/libs/hash.php');
$hash = new Hash();


if (!empty($_GET)) {
    $user_name = '';
    $pass = '';
    $success = true;

    if (!$_GET['user'] || $_GET['user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input username';
        $success = false;
    } else $user_name = $_GET['user'];

    if (!$_GET['pass'] || $_GET['pass'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input password';
        $success = false;
    } else $pass = $_GET['pass'];

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
            echo $token;

            $data = array(
                "token" => $token,
                "token_started_at" => $date
                );
            print_r($data);
            //            insert token vaof DB

            $db->where('id', $user['id']);
            $db->update('member', $data);

            $db->where("user_name", $user_name);
            $db->where("password", $pass);
            $user = $db->getOne('member');
//            print_r($result);
            $xml_root_tag = '<user></user>';
            $result = $user;
            include($root . '/libs/convert_format.php');
//            echo 'login thanh cong';
            exit;
        } else {
            echo 'login that bai';
            exit;
        }
    } else {
        $_SESSION['flash'] = $flash;
        echo 'login that bai';
        exit;
    }
} else {
    echo 'khong login duoc';
}