<?php
    require('../admin/cfg.php');
    $mysqli = connectDB();
    $login = $_SESSION['login'];
    $user = $mysqli->query('SELECT * FROM users WHERE login ="'.$login.'"');
    $user = $user->fetch_assoc();
    class productInfo {
        public $id, $count = 0;
    }

    if($user['telephone'] == 0){
        echo json_encode(array('error' => 'phone'));
        return;
    } else {
        $card = isset($_SESSION['card']) ? $_SESSION['card'] : array();
        foreach($card as $value){
            $buyers = $mysqli->query('SELECT buyers, buyers_count FROM products WHERE id="'.$value->id.'"');
            $buyers = $buyers->fetch_assoc();

            $buyers = is_array($buyers) ? json_decode($buyers['buyers'], true) : array();
            if(empty($buyers)){
                $buyers = array($login => $value->count);
            } else if(isset($buyers[$login])){
                $buyers[$login] += $value->count;
            } else {
                $buyers[$login] = $value->count;
            }
            $buyers_count = 0;
            foreach($buyers as $key){
                $buyers_count++;
            }
            $buyers = json_encode($buyers);
            $mysqli->query('UPDATE products SET buyers=\''.$buyers.'\', buyers_count="'.$buyers_count.'" WHERE id="'.$value->id.'"');

        }

        echo json_encode(array());
        unset($_SESSION['card']);
        unset($_SESSION['cost']);
        unset($_SESSION['count']);
    }