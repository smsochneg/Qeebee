<?php
include('cfg.php');     //including config file
error_reporting(E_ALL);
#session_unset();
?>
<!doctype html>
<html lang="en">
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
        <div class="moto">������ ���� ��� fghrtr ��</div>
        <div class="offset6 span3 card">
        <?                                                                                              //showing a buying card

        if(isset($_SESSION['count']))
            echo 'you have:<div class="count-of-products" >'.$_SESSION['count'].'</div > products .';
        else
            echo 'you have:<div class="count-of-products" >0</div > products .';

        if(isset($_SESSION['cost']))
            echo '  cost: <div class="cost-of-products" >'.$_SESSION['cost'].'</div > roub .';
        else
            echo '  cost: <div class="cost-of-products" >0</div > roub .';

        ?>
            <a href="card.php"><button>Offer</button></a>
        </div>
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
                    echo '<li class="span2 logout">'.$_SESSION['login'].' (Logout)</li>';
                else
                    echo '<a href="login.php"><li class="span2">Login</li></a>';
            ?>
        </ul></div>
    <div class="row span3 left-bar"></div>
    <?

?>