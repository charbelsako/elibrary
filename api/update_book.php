<?php
    require("../php/DAL.class.php");
    $conn = new DAL();
    $conn->connect();

    $id = $conn->escape($_POST['id']);

    $title = $conn->escape($_POST['title']);    
    $price = $conn->escape($_POST['price']);    
    $quantity = $conn->escape($_POST['quantity']);    
    $publication_date = $conn->escape($_POST['date']);    
    $isbn = $conn->escape($_POST['isbn']);    
    $author = $conn->escape($_POST['author']);    
    $cats = $conn->escape($_POST['categories']);    

    $sql = "UPDATE book SET title='$title', price='$price', quantity='$quantity', publication_date='$publication_date', ISBN='$isbn', author_id='$author', category_id='$cats' WHERE id='$id'";
    echo $conn->ExecuteQuery($sql);
?>
