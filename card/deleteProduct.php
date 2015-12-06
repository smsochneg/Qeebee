<?php
    require('Z:/home/qeebee.ru/www/cfg.php');
    session_start();
    class productInfo {
        public $id, $count = 0;
    }

    $mysqli = connectDB();

    $product = $mysqli->query('SELECT * FROM products WHERE id="'.$_POST['id'].'"');
    $cost = $product->fetch_assoc();

    foreach($_SESSION['card'] as $key => $val){
        if($_SESSION['card'][$key]->id == $_POST['id']) {
            $_SESSION['count'] -= $_SESSION['card'][$key]->count;
            $_SESSION['cost'] -= $_SESSION['card'][$key]->count * $cost['cost'];
            unset($_SESSION['card'][$key]);
            if($_SESSION['card'] == null) unset($_SESSION['card']);
            break;
        }
    }
    echo json_encode(array("session" => $_SESSION));