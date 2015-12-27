<?php
    require('header.php');
    $mysqli = connectDB();
    $products = $mysqli->query('SELECT * FROM products ORDER BY change_date DESC');                               //showing all products
    while($res = $products->fetch_assoc()){
        $is = $res['availability'] ? 'Есть в наличии' : 'Не в наличии';

        echo '    <div class="product">
                                  <div class="name">'.$res['name'].'</div>
                                  <div class="cost">'.$res['cost'].'</div>
                                  <img class="photo" src="/images/products/'.$res['img_url'].'">
                                  <button class="delete" value="'.$res['id'].'">Удалить</button>
                                  <a href="edit.php?id='.$res['id'].'"><button class="edit">Редактировать</button></a>
                                  '.$is.'
                                  </div>


                             ';
    }
?>
    <div class="window">
        <p>Вы уверены что хотите удалить этот объект?</p>
        <div class="yes"><button>ДА</button></div>
        <div class="no"><button>НЕТ</button></div>
    </div>
    <script src="delete.js"></script>
<?   require ('footer.php');