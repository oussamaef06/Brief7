<?php
include "../db.inc.php";
if (isset($_POST["admin_submit"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        header("Location: ./login.php?username=empty");
        exit;
    } else if (empty($password)) {
        header("Location: ./login.php?password=empty");
        exit;
    }

    $sql = "SELECT * FROM user WHERE user_email='admin'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $hashedPassword = $row["password"];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["adminLogin"] = true;
            header("Location: ./admin.php?login=success");
            exit;
        }
    }
    echo $hashedPassword;
    // header("Location: ./login.php?error=somethingWrong");
    exit;
} else
    header("Location: ../index.php");
