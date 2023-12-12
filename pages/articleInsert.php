<?php
    include "../includes/db.inc.php";
    $comment = $_POST["text_cmt"];
    $date_cmt = date('Y-m-d H:i:s');
    $userId = $_SESSION["user_id"];
    $a  = $_POST["articleId"];
    $sql = "INSERT INTO comment (text_cmt, date_cmt, creator_id, article_id) 
    VALUES 
     ('$comment', '$date_cmt', '$userId', '$a')";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

