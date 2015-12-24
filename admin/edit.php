<?php
    require('header.php');
    $mysqli = connectDB();
    $id = $mysqli->real_escape_string($_GET['id']);
    $products = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    echo $mysqli->error;
    while($res = $products->fetch_assoc()){

        echo '    <form method="post">
                                      <input class="name" type="text" value="'.$res['name'].'" >
                                      <div class="cost">'.$res['cost'].'</div>
                                      <img class="photo" src="/images/products/'.$res['img_url'].'">
                                      <button class="delete" value="'.$res['id'].'">Delete</button>
                                      <a href="edit.php?id='.$res['id'].'"><button class="edit">Edit</button></a>
                                      </div>

                  </form>
                                 ';     //<---- сделать форму редактирования продукта

    }