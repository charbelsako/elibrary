<?php
    require("../php/DAL.class.php");
    require("../php/functions.php");
    
    $database = new DAL();
    $database->connect();
    
    // Get POST vars & sanitize data
    $username = $database->escape($_POST["username"]);
    $password = $database->escape($_POST["password"]);
    $email = $database->escape($_POST["email"]);
    $name = $database->escape($_POST["name"]);
    
    $sql = "INSERT INTO user (name, username, password, email) VALUES ('$name', '$username', '$password', '$email')";
    $result = $database->ExecuteQuery($sql);

    echo $result;
    
?>