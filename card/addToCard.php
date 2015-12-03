<?php
    require('Z:/home/qeebee.ru/www/cfg.php');                               //cfg file with connecting to db
    if(isset($_POST['count'])) $count = $_POST['count']; else $count = 0;
    if(isset($_POST['add'])) $id = $_POST['add'];
    $mysqli = connectDB();

    $product = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    if(!($cost = $product->fetch_assoc())){ return false;}
    if(!(isset($_SESSION['card']['productId#'.$id])))
        $_SESSION['card']['productId#'.$id] = array();

    $_SESSION['card']['productId#'.$id]['id'] = $id;
    $_SESSION['card']['productId#'.$id]['count'] += $count;


    $_SESSION['count'] += $count;
    $_SESSION['cost'] += $cost['cost'] * $count;
    echo json_encode(array("count" => $count, "cost" => ($cost['cost'] * $count)));


class addToCard
{

}