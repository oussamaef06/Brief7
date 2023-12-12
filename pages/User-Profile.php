<?php include("../includes/db.inc.php");
if (empty($_SESSION["user_id"]) || empty($_SESSION["login"])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../pictures/avito.png" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Avito</title>
</head>

<body class="bg-gray-300 " style="background-color: #d5deef;">

    <!------------------------------------------start navbar---------------------------------------------- -->


    <div id="navbar-container"><?php include("../js/navbar.php"); ?></div>
    <script src="../js/script.js"></script>

    <?php
    if (isset($_SESSION["user_id"])) {
        $userId = $_SESSION["user_id"];
        $userInfo = getSpecificUser($userId, $conn);
        $username = $userInfo["user_name"];
        $usercity = $userInfo["city"];
        $userpic = $userInfo["user_picture"];
        $userphone = $userInfo["user_phone"];
        $useremail = $userInfo["user_email"];
        $commentCount = getuserCommentCount($conn, $userId);
        $articleCount = getuserArticleCount($conn, $userId);
    }
    ?>
    <!------------------------------------------end navbar---------------------------------------------- -->





    <!------------------------------------------start container---------------------------------------------- -->






    <!-- component -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    <section class="pt- mx-10 mb-20 bg-transparent">
        <div class="w-full flex justify-center px-4 mx-auto">
            <div class="lwa3er w-[1000px] z-10 flex flex-col break-words bg-white opacity-90  mb-6 shadow-xl rounded-lg mt-16" class="absolute flex flex-col min-w-0 break-words w-full bg-white opacity-90  mb-6 shadow-xl rounded-lg mt-16" style="margin-top: 100px;">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full px-4 flex justify-center">
                            <div class="relative">
                                <?php echo '<img src="data:image/png;base64,' . base64_encode($userpic) . '" alt="" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">';
                                ?>
                            </div>
                        </div>
                        <div class="w-full px-4 text-center ml-8 mt-20">
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        <?= $articleCount ?>
                                    </span>
                                    <span class="text-sm text-blueGray-400">Annonces</span>
                                </div>
                                <div class="lg:mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        <?= $commentCount ?>
                                    </span>
                                    <span class="text-sm text-blueGray-400">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-12">
                        <a href="./EditUserProfile.php" class="relative inline-flex items-center justify-center p-4 px-6 py-3 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-purple-500 rounded-full shadow-md group">
                            <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-purple-500 group-hover:translate-x-0 ease">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                            <span class="absolute flex items-center justify-center w-full h-full text-purple-500 transition-all duration-300 transform group-hover:translate-x-full ease">Edit</span>
                            <span class="relative invisible">Button</span>
                        </a>

                        <a onclick="ShowDeleteAlert(<?php echo $_SESSION['user_id'] ?>)" class="relative inline-flex items-center justify-center p-4 px-6 py-3 overflow-hidden font-medium text-red-600 transition duration-300 ease-out border-2 border-red-500 rounded-full shadow-md group">
                            <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-red-500 group-hover:translate-x-0 ease">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                            <span class="absolute flex items-center justify-center w-full h-full text-red-500 transition-all duration-300 transform group-hover:translate-x-full ease">Delete</span>
                            <span class="relative invisible">Button</span>
                        </a>
                        <h3 class="text-xl py-4 font-bold leading-normal mb-2 text-blueGray-700 mb-2">
                            <?php echo $userInfo["user_name"] ?>
                        </h3>
                        <div class="text-sm py-2 leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                            <i class="fas fa-phone mr-2 text-lg text-blueGray-400"></i>
                            +212<?php echo $userInfo["user_phone"] ?>
                        </div>
                        <div class="mb-2 text-blueGray-600 mt-10">
                            <i class="fas fa-mail-bulk mr-2 text-lg text-blueGray-400"></i>
                            <?php echo $userInfo["user_email"] ?>
                        </div>
                        <div class="mb-2 py-10 text-blueGray-600">
                            <i class="fas fa-city mr-2 text-lg text-blueGray-400"></i>
                            <?php echo $userInfo["city"] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="../pictures/profile-bg.jpg" alt="" width="100%" class="tswera" class="rounded-3xl hidden lg:block">

    </section>


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


        function ShowDeleteAlert(id) {
            console.log(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    href = "../includes/profile-crud/delete_profile.php"
                    window.location.href = "http://localhost/Winners_Blog/includes/profile-crud/delete_profile.php?user_id=" + id;
                }
            });
        }
    </script>

    <!----------------------------- end footer ------------------------------------->


</body>

</html>