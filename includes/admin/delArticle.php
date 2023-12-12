<?php
include "../db.inc.php";
if (isset($_GET["articleId"])) {
    $articleId = filter_input(INPUT_GET, "articleId", FILTER_DEFAULT);
    $date = date("Y-m-d H:i:s");
    $sql = "UPDATE article SET soft_delete='$date' WHERE id_article= '$articleId'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    header("Location: ./admin.php?article=deleted");
} else {
    header("Location: ../index.php");
}