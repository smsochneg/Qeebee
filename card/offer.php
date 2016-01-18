<?php
    require('../admin/cfg.php');
    $mysqli = connectDB();
    $login = $_SESSION['login'];
    $user = $mysqli->query('SELECT * FROM users WHERE login ="'.$login.'"');
    $user = $user->fetch_assoc();

    if($user['telephone'] == 0){
        echo json_encode(array('error' => 'phone'));
        return;
    } else {
        /* ПРИДУМАТЬ КАК РЕАЛИЗОВАТЬ ЗАКАЗ */

        unset($_SESSION['card']);
        unset($_SESSION['cost']);
        unset($_SESSION['count']);
    }