<?php
    include('header.php');


        $id = $_GET['id'];                                                              //getting id from get
        $mysqli = connectDB();                                                          //connecting to db
        $product = $mysqli->query('SELECT * FROM products WHERE id='.$id);              //search for such item
        $current = $product->fetch_assoc();
        echo '<div class="product-full span9">

            <div class="name">'.$current['name'].'</div>
            <img class="photo" src="/images/products/'.$current['img_url'].'">
            <div class="description"><pre>'.$current['description'].'</pre></div>
            <div class="buy">
                <input type="number" value="0" id="add'.$current['id'].'" min="0">
                <button name="add" class="add" value="'.$current['id'].'">add</button>
            </div>
          </div>';                                                                      //add it to the page

include('footer.php');
?>
<script src="card/add.js"></script>