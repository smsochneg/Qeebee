<?php
    require('header.php');

    $mysqli = connectDB();

    if(isset($_POST['add'])) {
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

            } else {
                $img_url = 'default.png';
            }
        } else {
            $img_url = 'default.png';
        }                                                                                                               // конец блока загрузки файла



        $mysqli->query('INSERT INTO products(name, description, img_url, change_date, cost, category) VALUES ("'.$name.'", "'.$desc.'", "'.$img_url.'", "'. date('Y-m-d') .'", "'. $cost .'", "'.$category.'")');
        header('Location: products.php');
    }

?>

    <form method="post" enctype="multipart/form-data">
        <input class="name" name="name" type="text" value="" placeholder="Имя продукта" required>
        <input type="number" name="cost" value="0" min="0" placeholder="Цена продукта" required>
        <textarea name="desc" class="desc" placeholder="Описание товара" required></textarea>
        <select name="categ" id="categ">
            <?
                $categ = $mysqli->query('SELECT * FROM categories WHERE parent!=0');
                while($out = $categ->fetch_assoc()){
                    echo '<option>'. $out['category'] .'</option>';
                }
            ?>
        </select>
        <input name="load" type="file">
        <input name="add" type="submit" value="Создать">
    </form>

<?
    require('footer.php');
?>