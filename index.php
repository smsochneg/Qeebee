<?php
    include('header.php');

    $mysqli = connectDB();
    $search = (isset($_POST['query'])) ? $mysqli->real_escape_string($_POST['query']) : false;
    $category = isset($_GET['category']) ? $mysqli->real_escape_string($_GET['category']) : false;
    $query = 'SELECT SQL_CALC_FOUND_ROWS * FROM products WHERE availability=1 ';
    if($search != false){
        $query = $query.'AND name LIKE "%'.$search.'%" OR description LIKE "%'.$search.'%" ';
    } elseif($category != false){
        $query = $query.'AND category="'.$category.'" ';
    }
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $count = 1;
    $start = $page*$count - $count;

    $query = $query.' ORDER BY change_date DESC LIMIT '.$start.', '.$count;

    $products = $mysqli->query($query);                               //Вывод продуктов, отсортировав по дате редактирования
    $pages = $mysqli->query('SELECT FOUND_ROWS() as pages')->fetch_assoc();
    $pages = ceil($pages['pages'] / $count);
    $n_empty_flag = false;
    echo '<div class="row span9">';
    while($res = $products->fetch_assoc()){
            echo '    <div class="span product">
                                  <a class="full" href="full.php?id=' . $res['id'] . '">
                                  <div class="name">' . $res['name'] . '</div>
                                  <div class="cost">' . $res['cost'] . '</div>
                                  <div class="click">Нажмите для просмотра</div>
                                  <img class="photo" src="/images/products/' . $res['img_url'] . '">
                                  </a>

                                  </div>


                             ';
        $n_empty_flag = true;
     }
   if(!$n_empty_flag)echo 'Ничего не найдено.';

echo '</div>
      <div class="page">
';
    for($x = 1; $x <= $pages; $x++){
        echo '<a href="?page='.$x.'">'.$x.'</a>';
    }
echo '</div>';
    include('footer.php');
?>

