<?php

include("../includes/db.inc.php");
$a  = $_GET["id"];
$sqlCom = "SELECT * FROM comment WHERE article_id='$a'";
$comments = $conn->query($sqlCom);
$t = $comments->fetch_assoc();

function getArticleUser($articleId, $conn)
{
    $output = array();
    $sql = "SELECT
                article.*,
                user.id_user,
                user.user_name,
                user.user_phone,
                user.user_email,
                user.user_picture,
                user.city,
                user.password,
                user.soft_delete AS user_soft_delete
            FROM
                article
            JOIN
                user ON article.creator_id = user.id_user
            WHERE
                article.id_article=?";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $articleId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($res)) {
        $output[] = $row;
    }

    return $output;
}
// Retrieve the article ID from the URL
$articleId = isset($_GET['id']) ? $_GET['id'] : null;
// Check if the ID is valid
if ($articleId) {
    $user = getArticleUser($articleId, $conn);
    if (!empty($user)) { ?>


        <!DOCTYPE html>
        <html lang="en">


        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="../css/style.css">
            <link rel="icon" type="image/png" href="../pictures/avito.png" />
            <title>Avito</title>
        </head>

        <body class="bg-gray-300 " style="background-color: #d5deef;">

            <!------------------------------------------start navbar---------------------------------------------- -->

            <div id="navbar-container"><?php include("../js/navbar.php"); ?></div>
            <script src="../js/script.js"></script>


            <!------------------------------------------end navbar---------------------------------------------- -->






            <!------------------------------------------start container---------------------------------------------- -->



            <main class="pt-8 mx-10 rounded-2xl pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
                <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                    <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                        <header class="mb-4 lg:mb-6 not-format">
                            <address class="flex items-center mb-6 not-italic">
                                <?php foreach ($user as $singleUser) : ?>


                                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                        <?= '<img src="data:image/png;base64,' . base64_encode($singleUser["user_picture"]) . '" alt="profile_pic" class="mr-4 w-16 h-16 rounded-full" >'; ?>

                                        <div>
                                            <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">
                                                <?= $singleUser["user_name"]; ?>
                                            </a>
                                            <p class="text-base text-gray-500 dark:text-gray-400">
                                                <?= $singleUser["article_date"]; ?>
                                            </p>
                                        </div>
                                    </div>
                            </address>


                            <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                                <?= $singleUser['title'] ?></h1>

                        </header>
                        <?= '<img src="data:image/png;base64,' . base64_encode($singleUser["article_picture"]) . '" alt="blog" style="filter: invert(0);">'; ?>
                        <p class="lead text-[#9CA3A2]">
                            <?php echo $singleUser["description"]; ?>
                        </p>
                    <?php endforeach; 
                    
                    if (isset($_SESSION["login"])) {
                    ?>
                        
                    <form method="post" id="commentForm" class="py-2 mt-8 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="comment" class="sr-only">Your comment</label>
                        <input value=<?php echo $a; ?> name="articleId" type="hidden" />
                        <input id="text_cmt" name="text_cmt" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 outline-none focus:ring-0 " placeholder="Write a comment..." value="" required />
                        <button type="submit" name="submitComment" onclick="submitForm()" id="submitComment" class="inline-flex items-center py-2.5 px-4 text-xs font-md text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:blue-200 dark:focus:blue-700 hover:bg-primary-800">
                            Post comment
                        </button>
                    </form>

                        <?php }?>
                    <div id="commentSec">
                        <?php
                        while ($r = $comments->fetch_assoc()) {
                            $sqlUsr = "SELECT * FROM user WHERE id_user = '$t[creator_id]'";
                            $u = $conn->query($sqlUsr);
                            $username = $u->fetch_assoc();
                            echo "
                        <div class='flex items-center'>
                        <p class='text-sm text-gray-600 dark:text-gray-400'><time pubdate datetime='2022-02-08' title='February 8th, 2022'>$r[date_cmt]</time></p>
                        </div> 
                        ";
                            //echo "<p class='inline-flex items-center mr-3 font-semibold text-sm text-gray-900 dark:text-white'><img class='mr-2 w-6 h-6 rounded-full' src='https://flowbite.com/docs/images/people/profile-picture-2.jpg'>" . $username["user_name"] . "</p>";
                            //echo "<p class='text-white text-sm px-4 py-2 text-gray-700' id='commentDisplay'>" . $r["text_cmt"] ."</p>";

                            // Display user's profile picture and username for the comment
                            echo "
                        <div class='flex items-center'>
                            <img class='mr-2 w-6 h-6 rounded-full' src='data:image/png;base64," . base64_encode($username["user_picture"]) . "' alt='profile_pic'>
                            <p class='inline-flex items-center mr-3 font-semibold text-sm text-gray-900 dark:text-white'>
                                " . $username["user_name"] . "
                            </p>
                        </div>
        ";

                            echo "<p class='text-white text-sm px-4 py-2 text-gray-700' id='commentDisplay'>" . $r["text_cmt"] . "</p>";
                        }
                        ?>
                    </div>
                    </article>
                </div>
            </main>


            <!----------------------------------------- strat footer --------------------------------------------------->

            <div id="Footer-container"></div>
            <script src="../js/footer.js"></script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="https://daniellaharel.com/raindrops/js/raindrops.js"></script>

            <script>
                jQuery('#waterdrop').raindrops({
                    color: '#ffffff',
                    canvasHeight: 150,
                    density: 0.1,
                    frequency: 20
                });
            </script>

            <!----------------------------------------- get and post comment --------------------------------------------------->

            <script>
                $(document).ready(function() {

                    // Function to fetch comments without refreshing the page
                    function fetchComments() {
                        var articleId = <?php echo $a; ?>; // Get the article ID from PHP
                        //console.log("id: " + articleId);  // Check if the input is captured

                        $.ajax({
                            type: "GET",
                            url: "fetchComment.php",
                            data: {
                                article_id: articleId
                            },
                            success: function(response) {
                                // Parse the JSON response containing comments
                                var comments = JSON.parse(response);

                                $("#commentSec").empty();

                                // Iterate through comments and append them to the comment section
                                comments.forEach(function(comment) {
                                    console.log(comment);
                                    var htmlTemplate = `
                            <div class='flex items-center'>
                                <p class='text-white text-sm px-4 py-2 text-gray-700' > ${comment.text_cmt} </p>
                                <p class='text-sm text-gray-600 dark:text-gray-400'>
                                    <time pubdate datetime='${comment.date_cmt}' title='${comment.date_cmt}'>${comment.date_cmt}</time>
                                </p>
                            </div>
                        `;

                                    $("#commentSec").append(htmlTemplate);
                                });

                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }

                    // Call fetchComments when the page loads to display existing comments
                    fetchComments();

                    // Handle form submission to add new comments
                    $("#commentForm").submit(function(e) {
                        e.preventDefault();
                        submitForm();
                    });

                    // Function to submit the comment form
                    function submitForm() {
                        var formData = $("#commentForm").serialize();
                        $.ajax({
                            type: "POST",
                            url: "articleInsert.php",
                            data: formData,
                            success: function(response) {
                                $("#result").html(response);
                                // Optionally, you can fetch and append the new comment immediately
                                fetchComments();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });
            </script>
            <!------------------------------------------ end footer --------------------------------------------------------->
        </body>

        </html>
<?php
    } else {
        // Handle the case where the article does not exist
        echo "Article not found";
    }
} else {
    // Handle the case where the ID is not provided
    echo "Invalid article ID";
}
