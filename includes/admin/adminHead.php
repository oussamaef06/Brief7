
<?php
if (empty($_SESSION["adminLogin"])) {
	header("Location: ./Login.php");
    echo $_SESSION["adminLogin"];
	exit;
}
?>

<nav class='bg-blue-500 text-white font-bold flex justify-around py-2'>
    <div>
        <a class='px-8' href='admin.php'>dashboard</a>
        <a class='px-8' href='article.php'>Articles</a>
        <a class='px-8' href='addUser.php'>new user</a>
        <a class='px-8' href='addArticle.php'>new article</a>
        <a class='px-8' class='px-8' href='./editUser.php'>edit user</a>
        <a class='px-8' href='delUser.php'>remove user</a>
    </div>
    <form method='post' action="./logout.php">
        <button type='submit' name='logout'>logout</button>
    </form>
</nav>

