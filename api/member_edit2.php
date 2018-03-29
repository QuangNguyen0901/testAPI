<?php
include('../libs/config.php');
include($root . '/libs/MysqliDb.php');
include($root . '/libs/hash.php');
$hash = new Hash();

if (!empty(file_get_contents('php://input'))) {
    $post = json_decode(file_get_contents('php://input'), true);
    $login_user_name = '';
    $token = '';
    $member_id = null;
    $full_name = '';
    $pass = '';
    $role = null;
    $email = '';
    $image = '';
    $success = true;
    $flash['msg'] = '';

    if (!isset($post['login_user']) || $post['login_user'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input login_user ';
        $success = false;
    } else $login_user_name = $post['login_user'];

    if (!isset($post['token']) || $post['token'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input token ';
        $success = false;
    } else $token = $post['token'];

    if (!isset($post['member_id']) || $post['member_id'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'Please input member id ';
        $success = false;
    } else $member_id = $post['member_id'];

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

    if (!isset($post['role']) || $post['role'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'role empty ';
        $success = false;
    } else $role = $post['role'];

    if (!isset($post['email']) || $post['email'] == '') {
        $flash['type'] = 'error';
        $flash['msg'] .= 'email empty ';
        $success = false;
    } else $email = $post['email'];

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
                //Convert input pass to (chuoi ma hoa)
                $salt = $hash->random();
                $pass = $hash->create($pass, $salt);

                // insert data to db
                $data = array(
                    "full_name" => $full_name,
                    "password" => $pass,
                    "email" => $email,
                    "salt" => $salt,
                    "role"=> $role,
                );
                $db->where('id',$member_id);
                if ($db->update('member', $data))
                    echo $db->count . ' records were updated';
            } else {
                echo "het han token";
            }
        }else{
            echo "login that bai";
        }
    }else {
        print_r($flash);
    }
}


