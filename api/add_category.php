<?php
    require("../php/DAL.class.php");
    $conn = new DAL();
    $conn->connect();

    $name = $conn->escape($_POST['name']);    
    
    $sql = "INSERT INTO categories (name)
            VALUES ('$name')";
    echo $conn->ExecuteQuery($sql);
?>
