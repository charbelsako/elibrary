<?php
    require("../php/DAL.class.php");
    session_start();
    $database = new DAL();
    $database->connect();
    
    $book_id = $database->escape($_GET["book_id"]);
    $user_id = $database->escape($_SESSION["id"]);
    
    // Check If user_id is valid.
    $username = $database->escape($_SESSION["username"]);
    $password = $database->escape($_SESSION["password"]);
    
    $sql = "SELECT id FROM user WHERE username='$username' AND password='$password'";
    $result = $database->getData($sql);
    //
    $array = json_decode($result);
    if (sizeof($array) > 0) {
        // Add the user id and the book id to the cart table.
        $sql = "INSERT INTO cart (user_id, book_id) VALUES ('$user_id', '$book_id')";
        echo $database->ExecuteQuery($sql);
        exit;
    }
    echo "Something Went Wrong";
    
?>