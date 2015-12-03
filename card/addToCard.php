<?php
    require('Z:/home/qeebee.ru/www/cfg.php');                               //cfg file with connecting to db
    if(isset($_POST['count'])) $count = $_POST['count']; else $count = 0;
    if(isset($_POST['add'])) $id = $_POST['add'];
    $mysqli = connectDB();

    $product = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    $cost = $product->fetch_assoc();


    $_SESSION['count'] += $count;
    $_SESSION['cost'] += $cost['cost'] * $count;
    echo json_encode(array("count" => $count, "cost" => ($cost['cost'] * $count)));


class addToCard
{

}