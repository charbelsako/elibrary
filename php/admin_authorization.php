<?php

session_start();

require("DAL.class.php");

if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])){
    header('Location: login.php');
} else {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];

    // check if user actually exists
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND type='2'";
    $conn = new DAL();
    $data = $conn->getData($sql);

    if (sizeof($data) == 0){
        echo "Not authorized";
        exit;
    }
}

?>