<?php
include("db.inc.php");
if (isset($_POST["submit"])) {
    $article_title = $_POST["article_title"];
    $article_description = $_POST["article_description"];
    $category_id = $_POST["article_category"];
    $article_id = $_POST["articleID"];
    $user_id = $_SESSION["user_id"];
    $old_pic = $_SESSION["article_picture"];
    $date = date("F, j, Y");
    $article_pic = $_FILES["article_picture"]["tmp_name"];


    if (empty($article_pic)) {
        $article_pic = $old_pic;
    } else {
        $article_pic = file_get_contents($article_pic);
    }

    $query = "UPDATE article SET title=?, description=?, category_id=?, article_picture=?, article_date=? WHERE id_article=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "ssissi", $article_title, $article_description, $category_id, $article_pic, $date, $article_id);
    mysqli_stmt_execute($stmt);
    header("Location: ../pages/my_article.php?article=updated");
} else {
    header("Location: ../index.php");
}
