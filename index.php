<?php
    include('header.php');

            $mysqli = connectDB();
            $products = $mysqli->query('SELECT * FROM products');                               //showing all products
            echo '<div class="row span9">';
                while($res = $products->fetch_assoc()){

                    echo '    <div class="span product">
                              <a class="full" href="full.php?id='.$res['id'].'">
                              <div class="name">'.$res['name'].'</div>
                              <div class="cost">'.$res['cost'].'</div>
                              <img class="photo" src="/images/products/'.$res['img_url'].'">
                              </a>

                              </div>


                         ';

                }
            echo '</div>';
    include('footer.php');
?>

