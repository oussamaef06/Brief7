<?php
function getSpecificUser($userId, $conn)
{
    $sql = "SELECT * FROM user WHERE id_user=?";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    return ($row);
}

function getAllArticles($conn)
{

    $output = array();
    $sql = "SELECT a.id_article, a.title, a.description, a.article_picture, a.article_date, a.creator_id, a.soft_delete,
    c.id_category, c.category FROM article a
    LEFT JOIN category c ON a.category_id = c.id_category ORDER BY id_article DESC";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($res)) {
        $output[] = $row;
    }
    return ($output);
}

function getArticle($conn, $articleId)
{
    $sql = "SELECT a.id_article, a.title, a.description, a.article_picture, a.article_date, a.creator_id, a.soft_delete,
    c.id_category, c.category
FROM article a
LEFT JOIN category c ON a.category_id = c.id_category WHERE id_article=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $articleId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    return ($row);
}

function getcomments($articleID)
{

    $output = array();
    $sql = "SELECT * FROM article WHERE article_id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $articleID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($res)) {
        $output[] = $row;
    }
    return ($output);
}

function getArticleSpecific($userId, $conn)
{
    $sql = "SELECT a.id_article, a.title, a.description, a.article_picture, a.article_date, a.creator_id, a.soft_delete,
    c.id_category, c.category
FROM article a
LEFT JOIN category c ON a.category_id = c.id_category WHERE creator_id = ? GROUP BY id_article DESC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $articles = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $articles;
}

function getCommentCount($conn, $articleID)
{
    $sql = "SELECT * FROM comment WHERE article_id=? AND soft_delete IS NULL";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $articleID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($res);
    return $count;
}

function getuserCommentCount($conn, $userID)
{
    $sql = "SELECT * FROM comment WHERE creator_id=? AND soft_delete IS NULL";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($res);
    return $count;
}

function getuserArticleCount($conn, $userID)
{
    $sql = "SELECT * FROM article WHERE creator_id=? AND soft_delete IS NULL";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($res);
    return $count;
}


function getcategory($categoryID, $conn)
{

    $output = array();
    $sql = "SELECT * FROM category WHERE id_category=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $categoryID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($res)) {
        $output[] = $row;
    }
    return ($output);
}
