<?php

include("./db.inc.php");
include("utils/fetchData.php");

// Select the created or existing database
mysqli_select_db($conn, 'blog');


if (isset($_POST['input'])) {
    $input = $_POST['input'];

    // Using prepared statements for security
    $query = "SELECT * FROM Article WHERE title LIKE ? ";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $inputPattern);

    $inputPattern = $input . '%';

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($result) > 0) {
        echo "<section id='container' class='bg-white mb-32 mx-10 rounded-2xl text-gray-600 body-font'>";
        echo "<div class='bg-blue-500 text-white p-4 text-center  mb-4 rounded-2xl'>My Search Banner</div>";
        echo "<div class='container px-5 py-24 mx-auto'>";
        echo "<div class='flex flex-wrap -m-4 js-container'>";

        while ($row = mysqli_fetch_assoc($result)) {
            $categoryID = $row["category_id"];
            $categoryInfo = getCategory($categoryID, $conn);
            $commentCount = getCommentCount($conn, $row["id_article"]);


            if ($categoryInfo) {
                $categoryName = $categoryInfo[0]["category"];

                echo "<div class='p-4 md:w-1/3'>";
                echo "<div class='draggable h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden' draggable='true'>";
                echo "<img src='data:image/png;base64," . base64_encode($row["article_picture"]) . "' alt='blog' style='filter: invert(0);' class='lg:h-48 md:h-36 w-full object-cover object-center'/>";
                echo "<div class='p-6'>";
                echo "<h2 class='tracking-widest text-xs title-font font-medium text-gray-400 mb-1'>" . $categoryName . "</h2>";
                echo "<h1 class='title-font text-lg font-medium text-gray-900 mb-3'>" . $row["title"] . "</h1>";
                echo "<p class='leading-relaxed mb-3'>" . $row["description"] . "</p>";
                echo "<div class='flex items-center flex-wrap '>";
                echo "<a href='pages/article.php?id=" . $row['id_article'] . "' class='text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0'>Learn More";
                echo "<svg class='w-4 h-4 ml-2' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'>";
                echo "<path d='M5 12h14'></path><path d='M12 5l7 7-7 7'></path></svg></a>";
                echo "<span class='text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200'>";
                echo "<svg class='w-4 h-4 mr-1 text-gray-400' viewBox='0 0 122.88 122.89' xmlns='http://www.w3.org/2000/svg'>";
                echo "<title>date</title>";
                echo "<path d='M81.61,4.73C81.61,2.12,84.19,0,87.38,0s5.77,2.12,5.77,4.73V25.45c0,2.61-2.58,4.73-5.77,4.73s-5.77-2.12-5.77-4.73V4.73ZM66.11,105.66c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1ZM15.85,68.94c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1Zm25.14-10.1H107c.8,0,.8,10.1,0,10.1H91.25c-.8,0-.8-10.1,0-10.1ZM15.85,87.3c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1ZM41,87.3c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1Zm25.14,0c-.8,0-.8-10.1,0-10.1H107c.8,0,.8,10.1,0,10.1Zm-75.4,18.36c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1ZM29.61,4.73C29.61,2.12,32.19,0,35.38,0s5.77,2.12,5.77,4.73V25.45c0,2.61-2.58,4.73-5.77,4.73s-5.77-2.12-5.77-4.73V4.73ZM6.4,43.47H116.47v-22a3,3,0,0,0-.86-2.07,2.92,2.92,0,0,0-2.07-.86H103a3.2,3.2,0,0,1,0-6.4h10.55a9.36,9.36,0,0,1,9.33,9.33v92.09a9.36,9.36,0,0,1-9.33,9.33H9.33A9.36,9.36,0,0,1,0,113.55V21.47a9.36,9.36,0,0,1,9.33-9.33H20.6a3.2,3.2,0,1,1,0,6.4H9.33a3,3,0,0,0-2.07.86,2.92,2.92,0,0,0-.86,2.07v22Zm110.08,6.41H6.4v63.67a3,3,0,0,0,.86,2.07,2.92,2.92,0,0,0,2.07.86H113.55a3,3,0,0,0,2.07-.86,2.92,2.92,0,0,0,.86-2.07V49.88ZM50.43,18.54a3.2,3.2,0,0,1,0-6.4H71.92a3.2,3.2,0,1,1,0,6.4Z' fill='#808080' />";
                echo "</svg>";
                echo $row["article_date"];
                echo "</span>";
                echo "<span class='text-gray-400 inline-flex items-center leading-none text-sm'>";
                echo "<svg class='w-4 h-4 mr-1' stroke='currentColor' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round' viewBox='0 0 24 24'>";
                echo "<path d='M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z'></path>";
                echo "</svg>";
                echo $commentCount;
                echo "</span>";
                echo "</div></div></div></div>";

            }
        }

        echo "</div></div></div></section>";
    } else {
        echo "<section id='container' class='bg-white mb-32 mx-10 rounded-2xl text-gray-600 body-font'>";
        echo "<div class='container px-5 py-24 mx-auto'>";
        echo "<p>No data found</p>";
    }
} else {
    echo "Error in preparing the statement: " . mysqli_error($conn);
}
