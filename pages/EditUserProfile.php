<?php include("../includes/db.inc.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../pictures/avito.png" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/Button.css">
    <title>Avito</title>
</head>


<body class="bg-gray-300 " style="background-color: #d5deef;">

    <!------------------------------------------start navbar---------------------------------------------- -->


    <div id="navbar-container">
        <?php include("../js/navbar.php"); ?>
    </div>
    <?php
    if (isset($_SESSION["user_id"])) {
        $userId = $_SESSION["user_id"];
        $userInfo = getSpecificUser($userId, $conn);
        $username = $userInfo["user_name"];
        $userpic = $userInfo["user_picture"];
        $userphone = $userInfo["user_phone"];
        $useremail = $userInfo["user_email"];
        $usercity = $userInfo["city"];


        // $userCity = $userInfo[""]
    }
    ?>
    <script src="../js/script.js"></script>


    <!------------------------------------------end navbar---------------------------------------------- -->





    <!------------------------------------------start container---------------------------------------------- -->






    <!-- component -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    <form class="h-screen space-y-6 pt- mx-10 flex justify-center items-center  mb-20 bg-transparent" action="../includes/profile-crud/update_profile.php" method="post" enctype="multipart/form-data">
        <div class="lwa3er" class="flex  absolute">
            <div class="m-auto  w-[400px] sm:w-[450px] md:w-[600px] sm:w-[550px]  ">
                <div>
                    <button type="button" class="relative w-full flex justify-center items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-black rounded-md hover:bg-gray-900  focus:outline-none   transition duration-300 transform active:scale-95 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                            <g>
                                <rect fill="none" height="24" width="24"></rect>
                            </g>
                            <g>
                                <g>
                                    <path d="M19,13h-6v6h-2v-6H5v-2h6V5h2v6h6V13z"></path>
                                </g>
                            </g>
                        </svg>
                        <input type="file" name="newimage" accept="image/*" class="border-4 bg-black absolute w-96 mx-12 opacity-0">
                        <span class="pl-2 mx-1">Add new picture</span>

                    </button>
                    <div class="mt-5 bg-white rounded-lg shadow">
                        <div class="flex">
                            <div class="flex-1 py-5 pl-5 overflow-hidden">
                                <svg class="inline align-text-top" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                    <g>
                                        <path d="m4.88889,2.07407l14.22222,0l0,20l-14.22222,0l0,-20z" fill="none" id="svg_1" stroke="null"></path>
                                        <path d="m7.07935,0.05664c-3.87,0 -7,3.13 -7,7c0,5.25 7,13 7,13s7,-7.75 7,-13c0,-3.87 -3.13,-7 -7,-7zm-5,7c0,-2.76 2.24,-5 5,-5s5,2.24 5,5c0,2.88 -2.88,7.19 -5,9.88c-2.08,-2.67 -5,-7.03 -5,-9.88z" id="svg_2"></path>
                                        <circle cx="7.04807" cy="6.97256" r="2.5" id="svg_3"></circle>
                                    </g>
                                </svg>
                                <h1 class="inline text-2xl font-semibold leading-none">User Information</h1>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <input placeholder="Name" name="user_name" value="<?= $username ?>" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <div class="flex">
                                <div class="flex-grow w-10 pr-2"><input placeholder="City" name="user_city" value="<?= $usercity ?>" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                                <div class="flex-grow"><input placeholder="Phone number" name="user_phone" value="<?= $userphone ?>" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                            </div>
                            <input placeholder="Email" name="user_email" value="<?= $useremail ?>" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                        </div>

                        <hr class="mt-4">
                        <div class="flex flex-row-reverse p-3">
                            <div class="flex-initial pl-3">
                                <button type="submit" type="submit" class="animated-button">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                    </svg>
                                    <span class="text">Save</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                    </svg>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <img src="../pictures/profile-bg.jpg" alt="" width="100%" class="tswera" class="rounded-3xl hidden lg:block"> -->

    </form>


    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="Buy me a beer" href="https://www.avito.ma/" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full" src="../pictures/login_pic.png" />
            </a>
        </div>
    </div>


    <!------------------------------------------end container---------------------------------------------- -->






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

    <!----------------------------- end footer ------------------------------------->


</body>

</html>