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
</head>
<body>
<div class="container">
    <div class="main">
        <div class="panel">
            <a href="products.php"><span class="btn">Продукты</span></a>
            <a href="categories.php"><span class="btn">Категории</span></a>
            <a href="offers.php"><span class="btn">Заказы</span></a>
            <span class="logout">X</span>
        </div>
        <div class="settings">
