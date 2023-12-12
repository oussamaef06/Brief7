<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./db.inc.php");

if (isset($_POST["signup_submit"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $passwordRepeat = filter_input(INPUT_POST, "password-repeat", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
    $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_SPECIAL_CHARS);
    $userPicture = $_FILES["user-picture"]["tmp_name"];
    $userPicture = file_get_contents($userPicture);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username)) {
        echo "<br>$username<br>";
        echo "username is empty";
        exit;
    } else if (empty($email)) {
        echo "email is empty";
        exit;
    } else if (empty($password) || empty($passwordRepeat)) {
        echo "password is empty";
        exit;
    } else if (empty($phone)) {
        echo "phone is empty";
        exit;
    } else if ($password !== $passwordRepeat) {
        echo "the passwords is not the same";
        exit;
    }

    $sql = "SELECT * FROM user WHERE user_email=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) {
        if (!$row["soft_delete"]) {
             header("Location: ../pages/register.php?userRegister=alreadyExist");
            exit;
        } else {
            $userId = $row["id_user"];
            $sql = "UPDATE user SET user_name=?, user_phone=?, user_email=?, city=?, user_picture=?, password=?, soft_delete=NULL WHERE id_user='$userId'";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "there is an error 2" . mysqli_error($conn);
                exit;
            } else {
                mysqli_stmt_bind_param($stmt, "sissss", $username, $phone, $email, $city, $userPicture, $hashedPassword);
                mysqli_stmt_execute($stmt);
                header("Location: ../pages/login.php?signup=success&welcome=back");
            }
        }
    } else {
        $sql = "INSERT INTO user (user_name, user_phone, user_email, city, user_picture, password) VALUES (?,?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "there is an error 1" . mysqli_error($conn);
            exit;
        } else {
            mysqli_stmt_bind_param($stmt, "sissss", $username, $phone, $email, $city, $userPicture, $hashedPassword);
            mysqli_stmt_execute($stmt);
            header("Location: ../pages/login.php?signup=success");
        }
        mysqli_stmt_close($stmt);
    }
} else
    header("Location: ../index.php");
