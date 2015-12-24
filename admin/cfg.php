<?php
    ob_start();
    session_start(); //beginning session
    function connectDB()                //connecting to database
    {
        $mysqli = new mysqli("localhost",
            'smsochneg',
            'jvMkLPZ',
            'qeebee');
        return $mysqli;
    }