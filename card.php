<?php
    include('header.php');
    include('auth/auth.php');
    $mysqli = connectDB();
    if(isset($_POST['phone'])){
        $user = new auth();
        $user->set_number($_SESSION['login'], $_POST['number']);
    }
    class productInfo {
        public $id, $count = 0;
    }


?>
<span class="span9">
            <?
                echo '<div class="card-full">';
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
                    echo '<button name="offer" class="offer">Подтвердить заказ</button>';
                } else {
                    echo 'Ваша корзина пуста.';
                }
                echo '</div>';
            ?>
</span>

<div class="phone">
    <div class="close"></div>
    <h3>Для оформления заказа вы должны указать свой номер телефона для того, чтобы наши операторы связались с вами и обсудили условия покупки.</h3>
    <form class="phone_valid" method="post">
        <input type="number" name="number" class="number">
        <input type="submit" name="phone" class="submit" value="Подтвердить">
    </form>
</div>

<script src="card/change.js"></script>
<script src="card/offer.js"></script>
<script src="styles/js/phone.js"></script>
