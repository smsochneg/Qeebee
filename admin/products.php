<?php
    require('header.php');
    $mysqli = connectDB();
    $products = $mysqli->query('SELECT * FROM products');                               //showing all products
    while($res = $products->fetch_assoc()){

        echo '    <div class="product">
                                  <div class="name">'.$res['name'].'</div>
                                  <div class="cost">'.$res['cost'].'</div>
                                  <img class="photo" src="/images/products/'.$res['img_url'].'">
                                  </a>

                                  </div>


                             ';

    }

    require ('footer.php');