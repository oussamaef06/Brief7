<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <link rel="icon" type="image/png" href="../pictures/2.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="./../../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
        <h3>HELLO ADMIN </h3>
        <form action="./login_traitement.php" method="post">
            <div class="inputBox">
                <input id="uname" type="text" name="username" autocomplete="off" placeholder="Username">
                <input id="pass" type="password" name="password" autocomplete="off" placeholder="Password">
                <button name="admin_submit" class="button"> Login
                </button>
        </form>
    </div>
</body>



</html>