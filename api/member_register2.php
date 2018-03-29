<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');
include($root . '/libs/hash.php');
$hash = new Hash();

if (!empty(file_get_contents('php://input'))) {
    $post = json_decode(file_get_contents('php://input'), true);
    $user_name = '';
    $full_name = '';
    $pass = '';
    $role = 2;
    $email = '';
    $image = '';
    $success = true;
    $flash['msg']='';

    if (!isset($post['user']) || $post['user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'user empty ';
        $success = false;
    } else $user_name = $post['user'];

    if (!isset($post['full_name']) || $post['full_name'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'full_name empty ';
        $success = false;
    } else $full_name = $post['full_name'];

    if (!isset($post['pass']) || $post['pass'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'pass empty ';
        $success = false;
    } else $pass = $post['pass'];

    if (!isset($post['email']) || $post['email'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'email empty ';
        $success = false;
    } else $email = $post['email'];

    if ($success) {
        $db = new MysqliDb();
        $flash = NULL;

        //Convert input pass to (chuoi ma hoa)
        $salt = $hash->random();
        $pass = $hash->create($pass, $salt);

// insert data to db
        $data = array(
            "user_name" => $user_name,
            "full_name" => $full_name,
            "password" => $pass,
            "email" => $email,
            "salt" => $salt,
            "role" => 2,
        );
        $id = $db->insert ('member', $data);
        if($id)
            echo 'user was created. Id=' . $id;
    }else{
        print_r($flash);
    }
}

