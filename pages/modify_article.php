<?php
include("../includes/db.inc.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Modify Article</title>
</head>

<body class="bg-gray-300 " style="background-color: #d5deef;">


    <!------------------------------------------start navbar---------------------------------------------- -->


    <div id="navbar-container">
        <?php include("../js/navbar.php"); ?>
    </div>
    <?php
    // Fetch categories
    $categories = [];
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    $articleId = $_GET["articleId"];
    $article = getArticle($conn, $articleId);
    ?>
    <script src="../js/script.js"></script>


    <!------------------------------------------end navbar---------------------------------------------- -->


    <main class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl w-full">
            <form method="POST" action="../includes/modify_article_traitement.php" enctype="multipart/form-data">
                <input type="hidden" name="articleID" value="<?php echo $articleId; ?>">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so
                            be careful
                            what you share.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="col-span-full">
                                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Article Photo</label>
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <input type="file" id="article_picture" name="article_picture" class="sr-only">
                                            </label>
                                        </div>
                                        <input type="file" accept="image/*" name="article_picture">
                                        <?php $_SESSION["article_picture"] = $article["article_picture"]; ?>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="article_category" class="block text-sm font-medium leading-6 text-gray-900">Article Category</label>
                            <div class="mt-2">
                                <select id="article_category" name="article_category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo htmlspecialchars($category['id_category']); ?>">
                                            <?php echo htmlspecialchars($category['category']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label for="article_title" class="block text-sm font-medium leading-6 text-gray-900">Article
                                Title</label>
                            <div class="mt-2">
                                <input type="text" value="<?php echo $article["title"]; ?>" name="article_title" id="article_title" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="article_description" class="block text-sm font-medium leading-6 text-gray-900">Article
                                Description</label>
                            <div class="mt-2">
                                <input type="text" value="<?php echo $article["description"]; ?>" name="article_description" id="article_description" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="./my_article.php" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" name="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </main>
    </div>


    <!----------------------------- strat footer ------------------------------------->

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

    <!----------------------------- end footer ------------------------------------->
</body>

</html>