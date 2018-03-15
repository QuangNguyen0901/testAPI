<?php
include('../libs/config.php');
include($root . '/libs/connection.php');  //=>$conn
$query_content = mysqli_query($conn, 'SELECT * FROM member');

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
//echo $user_name;

    if ($success) {
        $db = new Database();
        $flash = NULL;
        $sql = "SELECT salt FROM member WHERE user_name = '$user_name'";
        echo $sql;
        $db->query($sql);
//        $db->bind([
//            ':user_name'=>$user_name
//        ]);
        $salt = $db->findOne()['salt'];
        $pass = $hash->create($pass, $salt);

        $sql = "SELECT * FROM member WHERE user_name = '$user_name' AND password = '$pass'";
        echo $sql;
        $db->query($sql);
//        $db->bind([
//            ':user_name'=>$user_name,
//            ':pass'=>$pass
//        ]);
        $user = $db->findOne();

        if ($db->rowCount() == 1) {
            $_SESSION['user'] = $user;
            header("Location:http://qblog.com/admin/");
            exit;
        } else {
            $_SESSION['flash'] = $flash;
            header("Location:http://qblog.com/admin/?m=user&a=login");
            exit;
        }
    } else {
        $_SESSION['flash'] = $flash;
        header("Location: http://qblog.com/admin/?m=user&a=login");
        exit;
    }
} else {
    include($url_common . '/app/backend/views/user/login.php');
}