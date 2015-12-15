<?php
include('admin/cfg.php');     //including config file
error_reporting(E_ALL);
#session_unset();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; utf-8" />
    <title>QeeBee</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="jquery-2.1.4.min.js"></script>
    <script src="auth/logout.js"></script>
</head>
<body>
<div class="container">
    <div class="row span12 header">
        <a href="/"><img src="images/qeebee.gif" alt="" class="span3 logo"></a>
        <div class="moto">Тут слоган</div>
        <?if(isset($_SESSION['login'])) {
            echo '<div class="offset6 span3 card">';
                                                                                           //showing a buying card
                if (isset($_SESSION['count']))
                    echo 'У вас:<div class="count-of-products" >' . $_SESSION['count'] . '</div > продуктов.';
                else
                    echo 'У вас:<div class="count-of-products" >0</div > продуктов .';

                if (isset($_SESSION['cost']))
                    echo '  На сумму: <div class="cost-of-products" >' . $_SESSION['cost'] . '</div > руб .';
                else
                    echo '  На сумму: <div class="cost-of-products" >0</div > руб .';
                echo '<a href="card.php"><button>Заказать</button></a>';
            echo '</div>';
            }

        ?>

    </div>
    <div class="row menu">
        <ul>
            <li class="span2"></li>
            <li class="span2"></li>
            <li class="span2"></li>
            <li class="span2"></li>
            <li class="span2"></li>
            <?                                                                                          // showing login
                if(isset($_SESSION['login']))
                    echo '<li class="span2 logout">'.$_SESSION['login'].' (Выйти)</li>';
                else
                    echo '<a href="login.php"><li class="span2">Login</li></a>';
            ?>
        </ul></div>
    <div class="row span3 left-bar">
        <?
            $mysqli = connectDB();
            $categories = $mysqli->query('SELECT * FROM categories WHERE parent="0"');
            while($curr = $categories->fetch_assoc()){
                echo '
                    <a href="category.php?id='.$curr['id'].'">
                        <span class="category">
                        '.$curr['category'].'
                        </span>
                    </a>
                ';
            }
        ?>
    </div>
    <?

?>