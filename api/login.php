<?php 
    session_start();

    error_reporting(E_ALL);
    ini_set("display errors", 1);
    
    require("../php/DAL.class.php");

    $username = $_GET["username"];
    $password = $_GET["password"];

    $conn = new DAL();
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->getData($sql);
    $array = json_decode($result);

    $num = sizeof($result);
    if ($num > 0) {
        // session_register("username");
        
        // session_register("password");
        // session_register("id");
        
        $_SESSION["username"] = $array[0]->username;
        $_SESSION["password"] = $array[0]->password;
        $_SESSION["id"] = $array[0]->id;
        $_SESSION["type"] = $array[0]->type;
        echo $result;
    } else {
        echo "null";
    }
?>