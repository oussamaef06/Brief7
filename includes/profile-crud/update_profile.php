<?php

include("../db.inc.php");
require("../utils/fetchData.php");

session_start();
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $userInfo = getSpecificUser($userId, $conn);
    $userpic = $userInfo["user_picture"];
    $new_picture = $_FILES["newimage"]["tmp_name"];
    $username = $_POST['user_name'];
    $userphone = $_POST['user_phone'];
    $usercity = $_POST['user_city'];
    $useremail = $_POST['user_email'];

    if (empty($new_picture)) {

        $new_picture = $userpic;
    } else {
        $new_picture = file_get_contents($new_picture);
    }

    $Update_sql = "UPDATE User SET user_name =?, user_phone=?, city=? ,user_email=? ,user_picture=? WHERE id_user=?";
    $stmt = mysqli_prepare($conn, $Update_sql);
    mysqli_stmt_bind_param($stmt, "sisssi", $username, $userphone, $usercity , $useremail, $new_picture, $userId);
    $result = mysqli_stmt_execute($stmt);


    header("Location: ../../pages/User-Profile.php?accountupdated");
    exit();
}
