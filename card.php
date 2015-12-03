<?php
    include('header.php');
    print_r($_SESSION);
    $mysqli = connectDB();
    class productInfo {
        public $id, $count = 0;
    }

?>
<span class="span9">
            <?
                foreach($_SESSION['card'] as $val){
                    $product = $mysqli->query('SELECT * FROM products WHERE id='.$val->id);
                    $current = $product->fetch_assoc();
                    echo '<div class="product-full span9">

                            <div class="name">'.$current['name'].'</div>
                            <img class="photo" src="/images/products/'.$current['img_url'].'">
                            <div class="buy">
                                <input type="number" value="'.$val->count.'" min="1" id="add'.$current['id'].'" min="0">
                                <button name="add" class="add" value="'.$current['id'].'">add</button>
                            </div>
                          </div>';
                }
            ?>
</span>

<script src="card/add.js"></script>
