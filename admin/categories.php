<?php
    require('header.php');
    $mysqli = connectDB();
    if(isset($_POST['newcat'])){
        if($_POST['categname'] != ''){
            $name = $mysqli->real_escape_string($_POST['categname']);
            $mysqli->query('INSERT INTO categories(category, parent) VALUES ("'.$name.'", "0") ');
        }
        unset($_POST);
    }
    if(isset($_POST['newsubcat'])){
        if($_POST['subcategname'] != ''){
            $name = $mysqli->real_escape_string($_POST['subcategname']);
            $parent = $mysqli->real_escape_string($_POST['parent']);
            $mysqli->query('INSERT INTO categories(category, parent) VALUES ("'.$name.'", "'.$parent.'") ');
        }
        unset($_POST);
    }
    $categories = $mysqli->query('SELECT * FROM categories WHERE parent="0"');
    echo '<table>';
    while($arr = $categories->fetch_assoc()){
        $inner = $mysqli->query('SELECT * FROM categories WHERE parent="'.$arr['id'].'"');
        echo '<tr><th>'.$arr['category'].'</th>';
        while($innerArr = $inner->fetch_assoc()){
            echo '<td>'.$innerArr['category'].'</td>';
        }
        echo '<td onclick=\'location.href="categories.php?edit=newsubcat&id='.$arr['id'].'"\' class="subcat">+</td></tr>';
    }
    echo '<td onclick="location.href=\'categories.php?edit=newcat\'" class="cat">+</td></table>';

    if(isset($_GET['edit'])){
        if($_GET['edit'] == 'newcat'){
            echo '<form action="" method="post">
                    <input type="text" name="categname" id="categname" placeholder="Имя новой категории">
                    <input type="submit" name="newcat" id="newcat" value="Создать">
                  </form>';
        }
        if($_GET['edit']=='newsubcat'){
            $parent = $mysqli->real_escape_string($_GET['id']);
            echo '<form action="" method="post">
                    <input type="text" name="subcategname" id="categname" placeholder="Имя новой подкатегории">
                    <input type="hidden" name="parent" value="'.$parent.'">
                    <input type="submit" name="newsubcat" id="newcat" value="Создать">
                  </form>';
        }
    }

 ?>



