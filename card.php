<?php
    include('header.php');
    include('auth/auth.php');
    $user = new auth();
    $mysqli = connectDB();
    if(isset($_POST['phone'])){                                         //если у чувака нет телефона

        $user->set_number($_SESSION['login'], $_POST['number']);
        unset($_POST);
    }
    class productInfo {
        public $id, $count = 0;
    }


?>
<span class="span9">
            <?
                echo '<div class="card-full">';                                                 //вывод всей карты
                if(isset($_SESSION['card'])){
                    foreach($_SESSION['card'] as $val) {
                            $product = $mysqli->query('SELECT * FROM products WHERE id=' . $val->id);
                            $current = $product->fetch_assoc();
                            echo '
                                    <div class="product-full span9" id="'.$val->id.'">

                                    <div class="name">' . $current['name'] . '</div>
                                    <img class="photo" src="/images/products/' . $current['img_url'] . '">
                                    <div class="buy">
                                        <input type="number" value="' . $val->count . '" min="1" id="add' . $current['id'] . '" min="0">
                                        <button name="add" class="add" value="' . $current['id'] . '">Изменить</button>
                                        <button name="delete" class="delete" value="' . $current['id'] . '">Удалить</button>
                                    </div>
                                  </div>';
                        }
                    echo '<button name="offer" class="offer">Подтвердить заказ</button>'.$user->error_msg;
                } else {
                    echo 'Ваша корзина пуста.';
                }
                echo '</div>';
            ?>
</span>

<div class="phone">                                                                                        <!--   форма добавления номера телефона   !-->
    <div class="close"></div>
    <h3>Для оформления заказа вы должны указать свой номер телефона для того, чтобы наши операторы связались с вами и обсудили условия покупки.</h3>
    <form class="phone_valid" method="post">
        <div class="num"><div class="seven">+7</div><input type="number" name="number" class="number"></div>
        <input type="submit" name="phone" class="submit" value="Подтвердить">
    </form>
</div>

<script src="card/change.js"></script>
<script src="card/offer.js"></script>
<script src="styles/js/phone.js"></script>
