<?php
    require('header.php');
    $mysqli = connectDB();
    $error = '';
    $id = $mysqli->real_escape_string($_GET['id']);

    if(isset($_POST['edit'])){
        if(!$_FILES['load']['error']){
            if( $_FILES['load']['type'] == 'image/jpeg' ||
                $_FILES['load']['type'] == 'image/jpg'  ||
                $_FILES['load']['type'] == 'image/bmp'  ||
                $_FILES['load']['type'] == 'image/png'  ||
                $_FILES['load']['type'] == 'image/gif')
            {
                move_uploaded_file($_FILES['load']['tmp_name'], '../images/products/'.$_FILES['load']['name']);
                $mysqli->query('UPDATE products SET img_url="'.$_FILES['load']['name'].'" WHERE id="'.$id.'"');

            }
        } else {
            $error = 'Проблема загрузки файла. Попробуйте снова.';
        }
    }

    $products = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    while($res = $products->fetch_assoc()){

        echo '    <form method="post" enctype="multipart/form-data">
                                      <input class="name" type="text" value="'.$res['name'].'" >
                                      <input class="cost" type="text" value="'.$res['cost'].'" >
                                      <img class="photo" src="/images/products/'.$res['img_url'].'">
                                      <input name="load" type="file">
                                      <button class="delete" value="'.$res['id'].'">Удалить</button>
                                      <input name="edit" type="submit" value="Редактировать">
                                      <span class="error">'.$error.'</span>

                  </form>
                                 ';     //<---- сделать форму редактирования продукта

    }