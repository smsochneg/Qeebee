<?php
    require('header.php');
    if(isset($_GET['id'] )) {
        $mysqli = connectDB();
        $categories = $mysqli->query('SELECT * FROM categories WHERE parent="'.$_GET['id'].'"');        // Выбор категорий из бд
        echo '<div class="row span9">';
        while($curr = $categories->fetch_assoc()) {
            echo '<a href="index.php?category='.$curr['category'].'">
                        <span class="category">
                        '.$curr['category'].'
                        </span>
                 </a>
                 ';
        }
        echo '</div>';
    }
