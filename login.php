<?php
    include('header.php');
    include('auth/auth.php');
    $user = new auth();
        if (isset($_GET['action'])) { //if we have action
            if($_GET['action'] == 'register') { //we register
                echo '
                      <form action="" method="post">
                      <input type="text" name="nick" placeholder="Логин" required>
                      <input type="email" name="email" placeholder="E-mail" id="">
                      <input type="password" name="pass" placeholder="Пароль" required>
                      <input type="password" name="r_pass" placeholder="Повторите пароль" required>
                      <input type="submit" name="register" value="Зарегистрироваться!">
                      </form>
                      ';
            }
            if($_GET['action'] == 'validate') { //we validate the register
                echo '<form action="" method="post">
                    <input type="text" name="code" id="">
                    <input type="submit" name="check" value="Проверить код">
                  </form>';
            }


        } else {  //login form if we don't have action
            echo '
                  <form action="" method="post">
                  <input type="text" name="nick" placeholder="Логин" required>
                  <input type="password" name="pass" placeholder="Пароль" required>
                  <input type="submit" name="login" value="Авторизироваться!">
                  </form>
                  <a href="?action=register">Register</a>
                  ';
        };
        if (isset($_GET['action']) and ($_GET['action'] == 'logout')) { //logouting
            $user->logout();
        }
        if (isset($_POST['login'])) {   //logging
            if ($user->login($_POST['nick'], $_POST['pass'])) ;
            else echo $user->error_msg;
        }
        if (isset($_POST['register'])) {//registering
            if ($user->register($_POST['nick'], $_POST['email'], $_POST['pass'], $_POST['r_pass'])) ;
            else echo $user->error_msg;

        }
        if(isset($_POST['check'])) {    //validating
            if(!($user->verify($_POST['code']))) echo $user->error_msg;
        }
    include('footer.php');