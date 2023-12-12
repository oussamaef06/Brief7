<?php

include("./db.inc.php");
if (isset($_POST["sigin_submit"])) {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($email)) {
        header("Location: ../pages/login.php?email=empty");
        echo $email;
        exit;
    } else if (empty($password)) {
        header("Location: ../pages/login.php?password=empty");
        exit;
    }

    $sql = "SELECT * FROM user WHERE user_email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "there is an error";
        exit;
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($res)) {
            $hashedPassword = $row["password"];
            if ($row["soft_delete"] !== NULL) {
                header("Location: ../pages/login.php?User=notFound");
                exit;
            }
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["user_id"] = $row["id_user"];
                $_SESSION["login"] = true;
                header("Location: ../index.php?login=success");
                exit;
            } else {
                header("Location: ../pages/login.php?password=incorrect");
                exit;
            }
        } else {
            header("Location: ../pages/login.php?user=notFound");
            exit;
        }
    }
} else
    header("Location: ../index.php");
