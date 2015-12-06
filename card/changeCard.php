<?php
    require('Z:/home/qeebee.ru/www/cfg.php');                               //cfg file with connecting to db
    class productInfo {
        public $id, $count = 0;
    }



    if(isset($_POST['count'])) $count = $_POST['count']; else $count = 0;
    if(isset($_POST['add'])) $id = $_POST['add'];
    $mysqli = connectDB();

    $product = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    if(!$cost = $product->fetch_assoc()){ return false;}
    $info = new productInfo();
    $info->id = $id;

    foreach($_SESSION['card'] as $key => $val){
        if($_SESSION['card'][$key]->id == $info->id) {
            $_SESSION['count'] -= $_SESSION['card'][$key]->count;
            $_SESSION['count'] += $count;
            $_SESSION['cost'] -= $cost['cost'] * $_SESSION['card'][$key]->count;
            $_SESSION['cost'] += $cost['cost'] * $count;
            $_SESSION['card'][$key]->count = $count;
            break;
        }
    }

    echo json_encode(array("count" => $_SESSION['count'], "cost" => $_SESSION['cost']));
