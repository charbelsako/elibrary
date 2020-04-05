<?php
    require("../php/DAL.class.php");
    $conn = new DAL();
    $conn->connect();

    $title = $conn->escape($_POST['title']);    
    $price = $conn->escape($_POST['price']);    
    $quantity = $conn->escape($_POST['quantity']);    
    $publication_date = $conn->escape($_POST['date']);    
    $isbn = $conn->escape($_POST['isbn']);    
    $author = $conn->escape($_POST['author']);    
    $cats = $conn->escape($_POST['categories']);    

    $sql = "INSERT INTO book (title, price, quantity, publication_date, ISBN, author_id, category_id)
            VALUES ('$title', '$price', '$quantity', '$publication_date', '$isbn', '$author', '$cats')";
    echo $conn->ExecuteQuery($sql);
?>
