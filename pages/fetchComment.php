<?php
// Include your database connection here
include("../includes/db.inc.php");

if (isset($_GET['article_id'])) {
    $articleId = $_GET['article_id'];
    // Fetch comments based on the article ID
    $sqlCom = "
    SELECT c.id_cmt, c.text_cmt, c.date_cmt, c.creator_id, c.soft_delete,
           u.user_name, u.user_picture
    FROM comment c
    LEFT JOIN user u ON c.creator_id = u.user_name
    WHERE c.article_id = '$articleId';
";
    $comments = $conn->query($sqlCom);

    // Output comments as JSON
    $commentsArray = [];
    while ($row = $comments->fetch_assoc()) {
        $commentsArray[] = $row;
    }

    echo json_encode($commentsArray);
} else {
    echo "Invalid article ID";
}
