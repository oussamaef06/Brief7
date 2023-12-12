<?php

include("../db.inc.php");

if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $date = date("Y-m-d H:i:s");
    $Update_sql = "UPDATE User SET soft_delete = ? WHERE id_user = ?";

    $stmt = mysqli_prepare($conn, $Update_sql);
    mysqli_stmt_bind_param($stmt, "si", $date, $userId);
    $result = mysqli_stmt_execute($stmt);

    $Update_sql = "UPDATE article SET soft_delete = ? WHERE creator_id = ?";

    $stmt = mysqli_prepare($conn, $Update_sql);
    mysqli_stmt_bind_param($stmt, "si", $date, $userId);
    $result = mysqli_stmt_execute($stmt);

    $Update_sql = "UPDATE comment SET soft_delete = ? WHERE creator_id = ?";

    $stmt = mysqli_prepare($conn, $Update_sql);
    mysqli_stmt_bind_param($stmt, "si", $date, $userId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        session_destroy();
        header('location: ../../pages/login.php?deleted=true');
        exit();
    } else {
        echo "Error in updating account.";
    }
} else {
    echo "Error in deleting account.";
}
