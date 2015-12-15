<?php
    require('../admin/cfg.php');                               //cfg file with connecting to db
    class productInfo {
        public $id, $count = 0;
    }



    if(isset($_POST['count'])) $count = $_POST['count']; else $count = 0;
    if(isset($_POST['add'])) $id = $_POST['add'];
    $mysqli = connectDB();

    $product = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    if(!$cost = $product->fetch_assoc()){ return false;}
    if(!isset($_SESSION['card']))
        $_SESSION['card'] = array();
    $isInCard = false;
    $info = new productInfo();
    $info->id = $id;

    foreach($_SESSION['card'] as $key => $val){
        if($_SESSION['card'][$key]->id == $info->id) {
            $isInCard = true;
            $_SESSION['card'][$key]->count += $count;
            break;
        }
    }
    if(!$isInCard) {
        $info->count += $count;
        $_SESSION['card'][] = unserialize(serialize($info));
    }


    $_SESSION['count'] += $count;
    $_SESSION['cost'] += $cost['cost'] * $count;
    echo json_encode(array("count" => $count, "cost" => ($cost['cost'] * $count)));
