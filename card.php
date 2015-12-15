<?php
    include('header.php');
    $mysqli = connectDB();
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
                    echo '<button name="offer" class="offer">Оформить заказ</button>';
                } else {
                    echo 'Ваша корзина пуста.';
                }
                echo '</div>';
            ?>
</span>

<script src="card/change.js"></script>
<script src="card/offer.js"></script>
