<?php
include '../db.inc.php';
include "adminHead.php";

if (isset($_POST['submit'])) {
    $article_titles = $_POST["article_title"];
    $article_descriptions = $_POST["article_description"];
    $category_ids = $_POST["article_category"];
    $user_id = $_SESSION["user_id"];

    $query = "INSERT INTO article (title, description, category_id, article_picture, creator_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    for ($i = 0; $i < count($article_titles); $i++) {
        $article_title = $article_titles[$i];
        $article_description = $article_descriptions[$i];
        $category_id = $category_ids[$i];
        $article_picture = '';

        // Check if a file was uploaded
        if (!empty($_FILES['article_picture']['tmp_name'][$i])) {
            $article_picture = file_get_contents($_FILES['article_picture']['tmp_name'][$i]);
        }

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "ssisi", $article_title, $article_description, $category_id, $article_picture, $user_id);
            mysqli_stmt_execute($stmt);
        }
    }

    header('Location:addArticle.php?article=added');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../pictures/avito.png" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Avito</title>
</head>

<style>
    .btn-conteiner {
        display: flex;
        justify-content: center;
        --color-text: #ffffff;
        --color-background: #000000;
        --color-outline: #6a606380;
        --color-shadow: #00000080;
    }

    .btn-content {
        display: flex;
        align-items: center;
        padding: 5px 20px;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 25px;
        color: var(--color-text);
        background: var(--color-background);
        transition: 1s;
        border-radius: 100px;
        box-shadow: 0 0 0.2em 0 var(--color-background);
    }

    .btn-content:hover,
    .btn-content:focus {
        transition: 0.5s;
        -webkit-animation: btn-content 1s;
        animation: btn-content 1s;
        outline: 0.1em solid transparent;
        outline-offset: 0.2em;
        box-shadow: 0 0 0.4em 0 var(--color-background);
    }

    .btn-content .icon-arrow {
        transition: 0.5s;
        margin-right: 0px;
        transform: scale(0.6);
    }

    .btn-content:hover .icon-arrow {
        transition: 0.5s;
        margin-right: 25px;
    }

    .icon-arrow {
        width: 10px;
        margin-left: 15px;
        position: relative;
        top: 6%;
    }

    /* SVG */
    #arrow-icon-one {
        transition: 0.4s;
        transform: translateX(-60%);
    }

    #arrow-icon-two {
        transition: 0.5s;
        transform: translateX(-30%);
    }

    .btn-content:hover #arrow-icon-three {
        animation: color_anim 1s infinite 0.2s;
    }

    .btn-content:hover #arrow-icon-one {
        transform: translateX(0%);
        animation: color_anim 1s infinite 0.6s;
    }

    .btn-content:hover #arrow-icon-two {
        transform: translateX(0%);
        animation: color_anim 1s infinite 0.4s;
    }

    @keyframes color_anim {
        0% {
            fill: white;
        }

        50% {
            fill: var(--color-background);
        }

        100% {
            fill: white;
        }
    }

    @-webkit-keyframes btn-content {
        0% {
            outline: 0.2em solid var(--color-background);
            outline-offset: 0;
        }
    }

    @keyframes btn-content {
        0% {
            outline: 0.2em solid var(--color-background);
            outline-offset: 0;
        }
    }

    /* save all items button */
    .button {
        font-family: inherit;
        font-size: 20px;
        background: #212121;
        color: rgb(0, 0, 0);
        fill: rgb(0, 0, 0);
        padding: 0.7em 1em;
        padding-left: 0.9em;
        display: flex;
        align-items: center;
        border: 2 solid black;
        border-radius: 15px;
        font-weight: 1000;
    }

    .button span {
        display: block;
        margin-left: 0.3em;
        transition: all 0.3s ease-in-out;
    }

    .button svg {
        display: block;
        transform-origin: center center;
        transition: transform 0.3s ease-in-out;
    }

    .button:hover {
        background: #000;
    }

    .button:hover .svg-wrapper {
        transform: scale(1.25);
        transition: .5s linear;
    }

    .button:hover svg {
        transform: translateX(3em) scale(1.1);
        fill: #fff;
    }

    .button:hover span {
        opacity: 0;
        transition: .5s linear;
    }

    .button:active {
        transform: scale(0.95);
    }

    /* button add article  */
    .cssbuttons-io-button {
        background: rgb(93, 63, 225);
        margin-left: 120px;
        width: 300px;
        color: white;
        font-family: inherit;
        padding: 0.35em;
        padding-left: 1.2em;
        font-size: 17px;
        font-weight: 500;
        border-radius: 0.9em;
        border: none;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        box-shadow: inset 0 0 1.6em -0.6em #714da6;
        overflow: hidden;
        position: relative;
        height: 2.8em;
        padding-right: 3.3em;
        cursor: pointer;
    }

    .cssbuttons-io-button .icon {
        background: white;
        margin-left: 1em;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2.2em;
        width: 2.2em;
        border-radius: 0.7em;
        box-shadow: 0.1em 0.1em 0.6em 0.2em #7b52b9;
        right: 0.3em;
        transition: all 0.3s;
    }

    .cssbuttons-io-button:hover .icon {
        width: calc(100% - 0.6em);
    }

    .cssbuttons-io-button .icon svg {
        width: 1.1em;
        transition: transform 0.3s;
        color: #7b52b9;
    }

    .cssbuttons-io-button:hover .icon svg {
        transform: translateX(0.1em);
    }

    .cssbuttons-io-button:active .icon {
        transform: scale(0.95);
    }
</style>

<body class="bg-gray-300 " style="background-color: #d5deef;">


    <!------------------------------------------start navbar---------------------------------------------- -->


    <?php
    // Fetch categories
    $categories = [];
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    } ?>
    <script src="../js/script.js"></script>



    <!------------------------------------------end navbar---------------------------------------------- -->




    <div class="mt-60 space-y-6 flex justify-center items-center  mb-20 bg-transparent">
        <div id="articles-container">
            <div
                class="w-[600px] h-64 duration-500 group overflow-hidden relative rounded bg-neutral-800 text-neutral-50 p-4 flex flex-col justify-evenly">
                <div
                    class="absolute blur duration-500 group-hover:blur-none w-72 h-72 rounded-full group-hover:translate-x-12 group-hover:translate-y-12 bg-sky-900 right-1 -bottom-24">
                </div>
                <div
                    class="absolute blur duration-500 group-hover:blur-none w-12 h-12 rounded-full group-hover:translate-x-12 group-hover:translate-y-2 bg-indigo-700 right-12 bottom-12">
                </div>
                <div
                    class="absolute blur duration-500 group-hover:blur-none w-36 h-36 rounded-full group-hover:translate-x-12 group-hover:-translate-y-12 bg-indigo-800 right-1 -top-12">
                </div>
                <div
                    class="absolute blur duration-500 group-hover:blur-none w-24 h-24 bg-sky-700 rounded-full group-hover:-translate-x-12">
                </div>
                <div class="z-10 flex flex-col justify-evenly w-full h-full">
                    <span class="text-2xl font-bold">add article</article></span>
                    <p>
                    This information will be displayed publicly so be careful
              what you share.
                    </p>
                    <button class="cssbuttons-io-button" onclick="ShowModalForm()">
                        Add Article
                        <div class="icon">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div id="multipeForms" class=" bg-black/25 z-20 fixed hidden items-center justify-center  top-0  h-screen w-full">
        <div class=" flex flex-col gap-20 bg-white  h-[700px] overflow-y-scroll w-[700px] pt-[2px]  ">
            <div class="w-full h-[40px] flex justify-end p-2   border-b border-gray-100 ">
                <button onclick="ShowModalForm()">
                    <svg class="w-[30px]  h-[30px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.96965 8.96967C9.26254 8.67678 9.73742 8.67678 10.0303 8.96967L12 10.9394L13.9696 8.96969C14.2625 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0303L13.0606 12L15.0303 13.9697C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73744 15.3232 9.26256 15.3232 8.96967 15.0303C8.67678 14.7374 8.67678 14.2626 8.96967 13.9697L10.9393 12L8.96965 10.0303C8.67676 9.73744 8.67676 9.26256 8.96965 8.96967Z"
                                fill="#000000"></path>
                        </g>
                    </svg>
                </button>
            </div>
            <form class="space-y-6 mx-10 flex flex-col justify-center items-center mb-20 bg-transparent" method="POST"
                action="" enctype="multipart/form-data">
                <div id="Parent_form" class="flex flex-col">
                    <div class="flex ">
                        <div class="m-auto  w-[400px] sm:w-[450px] md:w-[600px] sm:w-[550px] ">
                            <div>
                                <button type="button"
                                    class="relative w-full flex justify-center items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-black rounded-md hover:bg-gray-900  focus:outline-none   transition duration-300 transform active:scale-95 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                        height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                                        <g>
                                            <rect fill="none" height="24" width="24"></rect>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M19,13h-6v6h-2v-6H5v-2h6V5h2v6h6V13z"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    <input type="file" id="article_picture" name="article_picture[]" accept="image/*"
                                        class="border-4 bg-black absolute w-96 mx-12 opacity-0">
                                    <span class="pl-2 mx-1">Add new picture</span>

                                </button>
                                <div class="mt-5 bg-white rounded-lg shadow">
                                    <div class="flex">
                                        <div class="flex-1 py-5 pl-5 overflow-hidden">
                                            <svg class="inline align-text-top" height="24px" viewBox="0 0 24 24"
                                                width="24px" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                <g>
                                                    <path d="m4.88889,2.07407l14.22222,0l0,20l-14.22222,0l0,-20z"
                                                        fill="none" id="svg_1" stroke="null"></path>
                                                    <path
                                                        d="m7.07935,0.05664c-3.87,0 -7,3.13 -7,7c0,5.25 7,13 7,13s7,-7.75 7,-13c0,-3.87 -3.13,-7 -7,-7zm-5,7c0,-2.76 2.24,-5 5,-5s5,2.24 5,5c0,2.88 -2.88,7.19 -5,9.88c-2.08,-2.67 -5,-7.03 -5,-9.88z"
                                                        id="svg_2"></path>
                                                    <circle cx="7.04807" cy="6.97256" r="2.5" id="svg_3"></circle>
                                                </g>
                                            </svg>
                                            <h1 class="inline text-2xl font-semibold leading-none">Article Information
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="px-5 pb-5">

                                        <div class="flex">
                                            <div class="flex-grow"><input placeholder="Article title"
                                                    name="article_title[]" id="article_title"
                                                    autocomplete="street-address"
                                                    class=" text-black placeholder-gray-600 w-[180px] sm:w-72 px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                            <select id="article_category" name="article_category[]"
                                                class="text-black ml-2 placeholder-gray-600 w-[180px] sm:w-52 md:w-72 px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                                <?php foreach ($categories as $category) : ?>
                                                <option
                                                    value="<?php echo htmlspecialchars($category['id_category']); ?>">
                                                    <?php echo htmlspecialchars($category['category']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                        <input placeholder="Paragraph" type="text" name="article_description[]"
                                            id="article_description"
                                            class=" text-black placeholder-gray-600 w-full h-[150px] px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                                    </div>

                                    <hr class="mt-4">
                                    <div class="flex flex-row-reverse p-3">
                                        <div class="flex-initial pl-3">
                                            <div class="btn-conteiner">
                                                <a onclick="addNewForm()" class="btn-content cursor-pointer">
                                                    <span class="btn-title">Add article</span>
                                                    <span class="icon-arrow">
                                                        <svg width="66px" height="43px" viewBox="0 0 66 43"
                                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="arrow" stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <path id="arrow-icon-one"
                                                                    d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path id="arrow-icon-two"
                                                                    d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path id="arrow-icon-three"
                                                                    d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                                                    fill="#FFFFFF"></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="button" type="submit" name="submit" class="flex z-96 flex-row justify-between">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg class="icon" height="30" width="30" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <span>Save all items</span>
                </button>
            </form>
        </div>

    </div>



    <!----------------------------- strat footer ------------------------------------->

    <div id="Footer-container">
    </div>
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
    <script>
        let container = document.getElementById("multipeForms");


        let form = `
       <div  class="flex ">
            <div class="m-auto  w-[400px] sm:w-[450px] md:w-[600px] sm:w-[550px] ">
                <div>
                    <button type="button"
                        class="relative w-full flex justify-center items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-black rounded-md hover:bg-gray-900  focus:outline-none   transition duration-300 transform active:scale-95 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                            viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                            <g>
                                <rect fill="none" height="24" width="24"></rect>
                            </g>
                            <g>
                                <g>
                                    <path d="M19,13h-6v6h-2v-6H5v-2h6V5h2v6h6V13z"></path>
                                </g>
                            </g>
                        </svg>
                        <input type="file" id="article_picture" name="article_picture[]" accept="image/*"
                            class="border-4 bg-black absolute w-96 mx-12 opacity-0">
                        <span class="pl-2 mx-1">Add new picture</span>

                    </button>
                    <div class="mt-5 bg-white rounded-lg shadow">
                        <div class="flex">
                            <div class="flex-1 py-5 pl-5 overflow-hidden">
                                <svg class="inline align-text-top" height="24px" viewBox="0 0 24 24" width="24px"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                    <g>
                                        <path d="m4.88889,2.07407l14.22222,0l0,20l-14.22222,0l0,-20z" fill="none"
                                            id="svg_1" stroke="null"></path>
                                        <path
                                            d="m7.07935,0.05664c-3.87,0 -7,3.13 -7,7c0,5.25 7,13 7,13s7,-7.75 7,-13c0,-3.87 -3.13,-7 -7,-7zm-5,7c0,-2.76 2.24,-5 5,-5s5,2.24 5,5c0,2.88 -2.88,7.19 -5,9.88c-2.08,-2.67 -5,-7.03 -5,-9.88z"
                                            id="svg_2"></path>
                                        <circle cx="7.04807" cy="6.97256" r="2.5" id="svg_3"></circle>
                                    </g>
                                </svg>
                                <h1 class="inline text-2xl font-semibold leading-none">Article Information</h1>
                            </div>
                        </div>
                        <div class="px-5 pb-5">

                            <div class="flex">
                                <div class="flex-grow"><input placeholder="Article title" name="article_title[]"
                                        id="article_title" autocomplete="street-address"
                                        class=" text-black placeholder-gray-600 w-[180px] sm:w-72 px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                                <select id="article_category" name="article_category[]"
                                    class="text-black ml-2 placeholder-gray-600 w-[180px] sm:w-52 md:w-72 px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo htmlspecialchars($category['id_category']); ?>">
                                        <?php echo htmlspecialchars($category['category']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <input placeholder="Paragraph" type="text" name="article_description[]"
                                id="article_description"
                                class=" text-black placeholder-gray-600 w-full h-[150px] px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                        </div>

                        <hr class="mt-4">
                        <div class="flex flex-row-reverse p-3">
                            <div class="flex-initial pl-3">
                                <div class="btn-conteiner">
                                                <a onclick="addNewForm()" class="btn-content cursor-pointer">
                                                    <span class="btn-title">Add article</span>
                                                    <span class="icon-arrow">
                                                        <svg width="66px" height="43px" viewBox="0 0 66 43"
                                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="arrow" stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <path id="arrow-icon-one"
                                                                    d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path id="arrow-icon-two"
                                                                    d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path id="arrow-icon-three"
                                                                    d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                                                    fill="#FFFFFF"></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    `

        function addNewForm() {

            document.getElementById("Parent_form").insertAdjacentHTML('afterend', form);


        }

        function ShowModalForm() {


            if (container.classList.contains("hidden")) {

                container.classList.replace("hidden", "flex");

            } else if (container.classList.contains("flex")) {
                container.classList.replace("flex", "hidden");

            }


        }
    </script>


    <!----------------------------- end footer ------------------------------------->
</body>

</html>