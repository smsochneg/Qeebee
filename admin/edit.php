<?php
    require('header.php');
    $mysqli = connectDB();
    $error = '';
    $id = $mysqli->real_escape_string($_GET['id']);

    if(isset($_POST['edit'])) {
        /*CHANGABLE VARIABLES*/

        $name = $mysqli->real_escape_string($_POST['name']);
        $cost = $mysqli->real_escape_string($_POST['cost']);
        $desc = $mysqli->real_escape_string($_POST['desc']);
        $img_url = $mysqli->real_escape_string($_FILES['load']['name']);
        $category = $mysqli->real_escape_string($_POST['categ']);

        /*        -//-       */
        if (!$_FILES['load']['error']) {                                                                                // загрузка файла
            if ($_FILES['load']['type'] == 'image/jpeg' ||
                $_FILES['load']['type'] == 'image/jpg' ||
                $_FILES['load']['type'] == 'image/bmp' ||
                $_FILES['load']['type'] == 'image/png' ||
                $_FILES['load']['type'] == 'image/gif'
            ) {
                move_uploaded_file($_FILES['load']['tmp_name'], '../images/products/' . $_FILES['load']['name']);
                $mysqli->query('UPDATE products SET img_url="' . $img_url . '" WHERE id="' . $id . '"');

            }
        } elseif($_FILES['load']['error'] == 4) {                                                                       // если файл не загружен, то не выдавать ошибки

        } else {
            $error = 'Проблема загрузки файла. Попробуйте снова.';
        }                                                                                                               // конец блока загрузки файла


        if ($name != $edit['name']) {                                                                          // изменение имени
            $mysqli->query('UPDATE products SET name="' . $name . '" WHERE id="' . $id . '"');
        }

        if ($cost != $edit['cost']) {                                                                          // изменение цены
            if(!$cost) $mysqli->query('UPDATE products SET cost="' . $cost . '", availability="0" WHERE id="' . $id . '"');
            else $mysqli->query('UPDATE products SET cost="' . $cost . '", availability="1"  WHERE id="' . $id . '"');
        }

        if ($desc != $edit['description']) {                                                                          // изменение описания
            $mysqli->query('UPDATE products SET description="' . $desc . '" WHERE id="' . $id . '"');
        }

        if ($category != $edit['category']) {                                                                          // изменение категории
            $mysqli->query('UPDATE products SET category="' . $category . '" WHERE id="' . $id . '"');
        }
        $mysqli->query('UPDATE products SET change_date="' . date('Y-m-d') . '" WHERE id="' . $id . '"');
    }

    $products = $mysqli->query('SELECT * FROM products WHERE id="'.$id.'"');
    $categories = $mysqli->query('SELECT * FROM categories WHERE parent!="0"');
    while($res = $products->fetch_assoc()){

        echo '    <form method="post" enctype="multipart/form-data">
                                      <input class="name" name="name" type="text" value="'.$res['name'].'" >
                                      <input type="number" name="cost" value="'. $res['cost'] .'" min="0">
                                      <img class="photo" src="/images/products/'.$res['img_url'].'">
                                      <textarea name="desc" class="desc">'.$res['description'].'</textarea>
                                      <select name="categ">
                                        <option selected disabled>'.$res['category'].'</option>';
                                            while($categ = $categories->fetch_assoc())
                                                echo '<option>'.$categ['category'].'</option>';
        echo'
                                      </select>
                                      <input name="load" type="file">
                                      <button class="delete" value="'.$res['id'].'">Удалить</button>
                                      <input name="edit" type="submit" value="Редактировать">
                                      <span class="error">'.$error.'</span>

                  </form>
                                 ';

    }