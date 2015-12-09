<?php
    require('header.php');
    if(isset($_GET['id'] )) {
        $mysqli = connectDB();
        $categories = $mysqli->query('SELECT * FROM categories WHERE parent="'.$_GET['id'].'"');
        while($curr = $categories->fetch_assoc()) {
            echo '<a href="catalog.php?category='.$curr['category'].'">
                        <span class="category">
                        '.$curr['category'].'
                        </span>
                 </a>
                 ';
        }
    }
