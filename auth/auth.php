
<?php //authentication system

class auth
{

    private $mysqli;
    public $error_msg;
    private $code;
    public function login($login, $pass){                                               //logging system
        $this->mysqli = connectDB();                                                    //connecting to db
        $users = $this->mysqli->query('SELECT * FROM users WHERE login="'.$this->mysqli->real_escape_string($login).'"');  //looking 4 users with entered login
        $users = $users->fetch_assoc();
        if($users['password'] == $pass){                                                //if passwords match
            $_SESSION['login'] = $users['login'];                                       //write login to session

            header('Location: /');                                                      //get back to the main page
            return true;
        }
        else{
            $this->error_msg = '<p>Wrong username or password!</p>';                    //else report a message
            return false;
        }


    }
    public function logout(){
        unset($_SESSION['login']);                                                      //just logout
        unset($_GET['action']);
    }
    public function register($login, $email, $pass, $r_pass, $name)                            //registering
    {
        $this->mysqli = connectDB();                                                    //connecting to db

        $login = $this->mysqli->real_escape_string($login);
        $this->code = md5($login.rand(0, 100));                                     //if passwords are the same we send a code
        $pass  = $this->mysqli->real_escape_string($pass);
        $name  = $this->mysqli->real_escape_string($name);
        $email = $this->mysqli->real_escape_string($email);
        $this->code  = $this->mysqli->real_escape_string($this->code);
        $users = $this->mysqli->query('SELECT * FROM users WHERE login="' . $this->mysqli->real_escape_string($login) . '" OR email="'. $this->mysqli->real_escape_string($email) .'"'); //looking if we have such user

        $users = $users->fetch_assoc();

        if ($users['email'] == $email) {                                                //reporting about user with such email
            $this->error_msg = '<p>User with such email is already registered!</p>';
            return false;
        }
        if ($users['login'] == $login) {                                                //reporting about user with such nickname
            $this->error_msg = '<p>There is a user with such nickname!</p>';
            return false;
        }
        if ($pass == $r_pass) {

            mail($email, 'Registration verification', $this->code);                     //<-
            $this->mysqli->query("INSERT INTO tmp_user(login, password, _name, email, reg_date, code)
                                                  VALUES ('$login',
                                                          '$pass',
                                                          '$name',
                                                          '$email',
                                                          '".date('Y-m-d')."',
                                                          '$this->code')");            //and inserting into a temporary db
            header('Location: login.php?action=validate');                             //and send user to a verification page

        } else {
            $this->error_msg = '<p>Passwords are different!</p>';
            return false;
        }
    }

    public function verify($code){                                                      //connect to db
        $this->mysqli = connectDB();
        $tmp_db = $this->mysqli->query('SELECT * FROM tmp_user WHERE code="'.$this->mysqli->real_escape_string($code).'"');//looking for user with a code that user wrote
        if($tmp_user = $tmp_db->fetch_assoc()) {

            $this->mysqli->query('INSERT INTO users(login, password, _name, email, reg_date)
                                                  VALUES ("' . $tmp_user['login'] . '",
                                                          "' . $tmp_user['password'] . '",
                                                          "' . $tmp_user['_name'] . '",
                                                          "' . $tmp_user['email'] . '",
                                                          "' . $tmp_user['reg_date'] . '")'); //if everything is ok we add to a normal db
            $this->mysqli->query('DELETE * FROM tmp_user WHERE code="'.$code.'" ');     //delete user from tmp db
            header('Location: login.php');                                              //back to the login page
            return true;
        } else {
            $this->error_msg = '<p>Invalid verification code!</p>';
            return false;
        }

    }

    public function set_number($login, $number){
        $this->mysqli = connectDB();
        $number = $this->mysqli->real_escape_string($number);
        $such_num = $this->mysqli->query('SELECT * FROM users WHERE telephone = "'.$number.'"');
        if(!$such_num->fetch_assoc())
            $this->mysqli->query('UPDATE users SET telephone="'.$number.'" WHERE login="'.$login.'"');
        else $this->error_msg = 'Данный номер используется другим пользователем.';
    }

}