<?php
    require('header.php');
    $mysqli = connectDB();
    if(isset($_GET['category']) and ($mysqli->query('SELECT * FROM products WHERE category="' . $_GET['category'] . '"')->fetch_assoc())) {
        $mysqli = connectDB();
        $products = $mysqli->query('SELECT * FROM products WHERE category="' . $_GET['category'] . '"');                               //showing all products
        echo '<div class="row span9">';
        while ($res = $products->fetch_assoc()) {

            echo '    <div class="span product">
                                  <a class="full" href="full.php?id=' . $res['id'] . '">
                                  <div class="name">' . $res['name'] . '</div>
                                  <div class="cost">' . $res['cost'] . '</div>
                                  <img class="photo" src="/images/products/' . $res['img_url'] . '">
                                  </a>

                                  </div>


                             ';

        }
    } else {
        echo 'Hmmm... I can\'t find anything!';
    }
    echo '</div>';