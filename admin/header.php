<?php
    require('cfg.php');
    if(!$_SESSION['admin'])
        header('Location: adminlog.php');

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>QeeBee | Admin Page</title>
    <link rel="stylesheet" href="styles/admin.css">
    <script src="../jquery-2.1.4.min.js"></script>
    <script src="logout.js"></script>
</head>
<body>
<div class="container">
    <div class="main">
        <div class="panel">
            <a href="products.php"><span class="btn">Продукты</span></a>
            <a href="categories.php"><span class="btn">Категории</span></a>
            <a href="offers.php"><span class="btn">Заказы</span></a>
            <img src="http://galaquest.ru/images/close.png" alt="Logout" class="logout">
        </div>
        <div class="settings">
