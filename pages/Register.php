<?php include("../includes/db.inc.php");
if (isset($_SESSION["login"])) {
    header("Location: ../index.php");
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

<style>
    .custum-file-upload {
        height: 130px;
        width: 400px;
        margin-left: 50px;
        display: flex;
        flex-direction: column;
        align-items: space-between;
        gap: 20px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        border: 2px dashed #cacaca;
        background-color: rgba(255, 255, 255, 1);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0px 48px 35px -48px rgba(0, 0, 0, 0.1);
    }

    .custum-file-upload .icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custum-file-upload .icon svg {
        height: 80px;
        fill: rgba(75, 85, 99, 1);
    }

    .custum-file-upload .text {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custum-file-upload .text span {
        font-weight: 400;
        color: rgba(75, 85, 99, 1);
    }

    .custum-file-upload input {
        display: block;
        width: 100px;
        z-index: 100;
    }
</style>

<body class="bg-gray-300 " style="background-color: #d5deef;">

    <!------------------------------------------start navbar---------------------------------------------- -->


    <div id="navbar-container"><?php include("../js/navbar.php"); ?></div>
    <script src="../js/script.js"></script>


    <!------------------------------------------end navbar---------------------------------------------- -->





    <!------------------------------------------start container---------------------------------------------- -->


    <div class="min-w-screen mb-32 min-h-screen flex items-center justify-center px-5 py-5">
        <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden">
            <div class="md:flex w-full">
                <div class="hidden md:block h-full">
                    <img src="../pictures/R.jpg" class="h-[800px]" alt="">
                </div>
                <div class="w-full md:w-1/2 flex flex-col items-center justify-center py-10 px-5 md:px-10">
                    <div class="text-center mb-10">
                        <h1 class="font-bold text-3xl text-gray-900">REGISTER</h1>
                        <p>Enter your information to register</p>
                    </div>
                    <form method="post" action="../includes/signup_traitement.php" enctype='multipart/form-data'>
                        <div class="flex -mx-3">
                            <label class="custum-file-upload" for="file">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="text">
                                    <span>Click to upload image</span>
                                </div>
                                <input type="file" id="file" accept="image/*" name="user-picture" required class="">
                            </label>

                        </div>
                        <div class="flex -mx-3">
                            <div class="w-1/2 px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">User name</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="text" name="username" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Ilyas Chaoui">
                                </div>
                            </div>
                            <div class="w-1/2 px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Phone number</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-phone-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="number" name="phone" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="06********">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Email</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-email-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="email" name="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="ilyaschaoui@example.com">
                                </div>
                            </div>
                            <div class="w-1/2 px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">City</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-city text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="text" name="city" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Your city">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-12">
                                <label for="" class="text-xs font-semibold px-1">Password</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="password" name="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************">
                                </div>
                            </div>
                            <div class="w-full px-3 mb-12">
                                <label for="" class="text-xs font-semibold px-1">Password Repeat</label>
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                    </div>
                                    <input type="password" name="password-repeat" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full flex items-center justify-center px-3 mb-5">
                                <button name="signup_submit" class="relative inline-flex items-center justify-start py-3 pl-4 pr-12 overflow-hidden font-semibold shadow text-indigo-600 transition-all duration-150 ease-in-out rounded hover:pl-10 hover:pr-6 bg-gray-50 group">
                                    <span class="absolute bottom-0 left-0 w-full h-1 transition-all duration-150 ease-in-out bg-indigo-600 group-hover:h-full"></span>
                                    <span class="absolute right-0 pr-4 duration-200 ease-out group-hover:translate-x-12">
                                        <svg class="w-full h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="absolute left-0 pl-2.5 -translate-x-12 group-hover:translate-x-0 ease-out duration-200">
                                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="relative w-full text-left transition-colors duration-200 ease-in-out group-hover:text-white">Register now</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        <?php
        if (isset($_GET["userRegister"])) { ?>
            Swal.fire({
                icon: "error",
                title: "User already exist!",
                text: "Change your email.",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        <?php } ?>
    </script>

    <!----------------------------- end footer ------------------------------------->


</body>

</html>