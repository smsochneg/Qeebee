<?php
    require('cfg.php');
    $mysqli = connectDB();
    $id = $mysqli->real_escape_string($_POST['id']);
    $mysqli->query('DELETE FROM products WHERE id='.$id);