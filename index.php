<?php include("./includes/db.inc.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./pictures/avito.png" />
    <link rel="stylesheet" href="./css/style.css">
    <title>Avito</title>
</head>

<body class="bg-gray-300 " style="background-color: #d5deef;">

    <!------------------------------------------start navbar---------------------------------------------- -->


    <div id="navbar-container"><?php include("./js/navbar_index.php"); ?></div>
    <?php
    $articles = getAllArticles($conn);
    ?>
    <script src="./js/script.js"></script>


    <!------------------------------------------end navbar---------------------------------------------- -->


    <!----------------------------------------start Countainer---------------------------------------------- -->

    <section id="container" class="bg-white mb-32 mx-10 rounded-2xl text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <?php
                foreach ($articles as $key => $value) {
                    $commentCount = getCommentCount($conn, $value["id_article"]);
                    if (!$value["soft_delete"]) {
                ?>
                        <div class="p-4 md:w-1/3">
                            <div class="h-[550px] border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <?php echo '<img src="data:image/png;base64,' . base64_encode($value["article_picture"]) . '" alt="blog" style="filter: invert(0);" class="lg:h-[390px] md:h-36 w-full object-cover object-center"/>'; ?>
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1"><?php echo $value["category"]; ?></h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?php echo $value["title"]; ?></h1>
                                    <p class="leading-relaxed mb-3"><?php echo $value["description"]; ?></p>
                                    <div class="flex items-center flex-wrap ">
                                        <a href="pages/article.php?id=<?php echo $value['id_article']; ?>" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 122.89" class="w-4 h-4 mr-1 text-gray-400">
                                                <title>date</title>
                                                <path d="M81.61,4.73C81.61,2.12,84.19,0,87.38,0s5.77,2.12,5.77,4.73V25.45c0,2.61-2.58,4.73-5.77,4.73s-5.77-2.12-5.77-4.73V4.73ZM66.11,105.66c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1ZM15.85,68.94c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1Zm25.14-10.1H107c.8,0,.8,10.1,0,10.1H91.25c-.8,0-.8-10.1,0-10.1ZM15.85,87.3c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1ZM41,87.3c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1Zm25.14,0c-.8,0-.8-10.1,0-10.1H107c.8,0,.8,10.1,0,10.1Zm-75.4,18.36c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1ZM29.61,4.73C29.61,2.12,32.19,0,35.38,0s5.77,2.12,5.77,4.73V25.45c0,2.61-2.58,4.73-5.77,4.73s-5.77-2.12-5.77-4.73V4.73ZM6.4,43.47H116.47v-22a3,3,0,0,0-.86-2.07,2.92,2.92,0,0,0-2.07-.86H103a3.2,3.2,0,0,1,0-6.4h10.55a9.36,9.36,0,0,1,9.33,9.33v92.09a9.36,9.36,0,0,1-9.33,9.33H9.33A9.36,9.36,0,0,1,0,113.55V21.47a9.36,9.36,0,0,1,9.33-9.33H20.6a3.2,3.2,0,1,1,0,6.4H9.33a3,3,0,0,0-2.07.86,2.92,2.92,0,0,0-.86,2.07v22Zm110.08,6.41H6.4v63.67a3,3,0,0,0,.86,2.07,2.92,2.92,0,0,0,2.07.86H113.55a3,3,0,0,0,2.07-.86,2.92,2.92,0,0,0,.86-2.07V49.88ZM50.43,18.54a3.2,3.2,0,0,1,0-6.4H71.92a3.2,3.2,0,1,1,0,6.4Z" fill="#808080" />
                                            </svg>
                                            <?php echo $value["article_date"]; ?>
                                        </span>
                                        <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                            <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                                </path>
                                            </svg><?php echo $commentCount; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="Buy me a beer" href="https://www.avito.ma/" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full" src="./pictures/login_pic.png" />
            </a>
        </div>
    </div>


    <!------------------------------------------end Countainer---------------------------------------------- -->

    <!-----------------------------  Search Results Display  ------------------------------------------------->
    <div id="searchresult"></div>


    <!------------------------------------------ strat footer -------------------------------------------------->

    <div id="Footer-container"></div>
    <script src="./js/footer_index.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://daniellaharel.com/raindrops/js/raindrops.js"></script>

    <script>
        jQuery('#waterdrop').raindrops({
            color: '#ffffffff',
            canvasHeight: 150,
            density: 0.1,
            frequency: 20
        });
    </script>

    <!----------------------------- end footer ------------------------------------->

    <!--------------------------------  Search script Start  --------------------------------->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        //ws = new WebSocket('ws://127.0.0.1:5500/');

        // Wait for the document to be fully loaded
        $(document).ready(function() {
            // When the user types in the input field with ID "live_search"
            $("#live_search").on("keyup", function() {
                // Get the value of the input
                var input = $(this).val();
                console.log("Input: " + input); // Check if the input is captured

                // Check if the input is not empty
                if (input != "") {
                    // Make an AJAX request to "search.php"
                    $.ajax({
                        url: "./includes/search.php",
                        method: "POST",
                        data: {
                            input: input
                        }, // Send the input data to the server
                        success: function(data) {
                            // When the request is successful, update the content of the element with ID "searchresult"
                            $("#searchresult").html(data);
                            // Hide elements with class "js-container"
                            $("#container").css("display", "none");
                        }
                    });
                } else {
                    $("#searchresult").css("display", "block");
                    $("#container").css("display", "block"); // Show all articles
                }

            });
        });
        <?php
        if (isset($_GET["passwdReset"])) { ?>
            Swal.fire({
                icon: "error",
            });
        <?php } ?>
    </script>

    <!--------------------------------  Search script End  --------------------------------->



</body>

</html>