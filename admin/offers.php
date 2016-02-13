<?php
    require('header.php');
    $mysqli = connectDB();
    if(isset($_GET['id'])){
        $id = $mysqli->real_escape_string($_GET['id']);
        $product = $mysqli->query('SELECT * FROM products WHERE id='.$id.' AND buyers_count >= 1');
        $product = $product->fetch_assoc();
        if($product){
            echo '    <div class="product">
                                      <div class="name">' . $product['name'] . '</div>
                                      <div class="cost">' . $product['cost'] . '</div>
                                      <img class="photo" src="/images/products/' . $product['img_url'] . '">
                                      </div>';
            $buyers = json_decode($product['buyers'], true);
            foreach($buyers as $login => $count){
                $buyer = $mysqli->query('SELECT * FROM users WHERE login="'.$login.'"');
                $buyer = $buyer->fetch_assoc();
                echo '<p>
                        <p>Имя пользователя: '.$login.'</p>
                        <p>Телефон: '.$buyer['telephone'].'</p>
                        <p>ФИО: '.$buyer['_name'].'</p>
                        <p>Количество: '.$count.'</p>
                        <hr>
                      </p>';
            }
        } else {
            echo '<div class="offer_error">Товар с данным идентификатором не был найден или на него не поступило заказов.</div>
                <a href="offers.php">Назад</a>
            ';
        }
    } else {

        $products = $mysqli->query('SELECT * FROM products WHERE buyers_count >= 1 ORDER BY change_date DESC');                               //showing all products
        while ($res = $products->fetch_assoc()) {
            $is = $res['availability'] ? 'Есть в наличии' : 'Не в наличии';

            echo '    <div class="product">
                                      <div class="name">' . $res['name'] . '</div>
                                      <div class="cost">' . $res['cost'] . '</div>
                                      <img class="photo" src="/images/products/' . $res['img_url'] . '">
                                      <a href="?id=' . $res['id'] . '"> Подробнее </a>
                                      </div>


                                 ';
        }

    }

   require ('footer.php');