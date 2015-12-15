<?php
    require('cfg.php');
    if(isset($_POST['submit'])){
        $mysqli = connectDB();
        $admins = $mysqli->query('SELECT * FROM admins WHERE login ="'.$mysqli->real_escape_string($_POST['login']).'"');
        $admins = $admins->fetch_assoc();
        if($admins != NULL){
            if($admins['password'] == $_POST['password']){
                $_SESSION['admin'] = true;
                header('Location: index.php');
            }

        } else {
            echo 'Ошибка входа!';
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="login" class="login" placeholder="Логин">
    <input type="password" name="password" class="password" placeholder="Пароль">
    <input type="submit" name="submit" class="submit" placeholder="Авторизация">
</form>
</body>
</html>
