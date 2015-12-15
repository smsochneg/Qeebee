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
            <div class="btn">Products</div>
            <div class="btn">Categories</div>
            <div class="btn">Offers</div>
        </div>
        <div class="settings"></div>
    </div>
</div>
</body>
</html>