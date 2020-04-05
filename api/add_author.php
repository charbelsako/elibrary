<?php
    require("../php/DAL.class.php");
    $conn = new DAL();
    $conn->connect();

    $name = $conn->escape($_POST['name']);    
    
    $sql = "INSERT INTO author (name)
            VALUES ('$name')";
    echo $conn->ExecuteQuery($sql);
?>
