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
    <link rel="icon" type="image/png" href="../pictures/avito.png" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body class="bg-gray-300 " style="background-color: #d5deef;">


    <!------------------------------------------start navbar---------------------------------------------- -->


    <div id="navbar-container"><?php include("../js/navbar.php"); ?></div>
    <script src="../js/script.js"></script>


    <!------------------------------------------end navbar---------------------------------------------- -->


    <!------------------------------------------strat container---------------------------------------------- -->



    <div class="flex mb-32  items-center justify-center h-screen">
        <!--- <img src="../pictures/Reset_pic.png" class="hidden md:block rounded-2xl" alt=""> --->
        <div class="ilyas w-96 bg-white mx-auto my-10 border-2 border-black rounded-2xl p-8 rounded-xl shadow shadow-slate-300" class="relative w-96 bg-white mx-auto my-10 border-2 border-black rounded-2xl p-8 rounded-xl shadow shadow-slate-300">
            <h1 class="text-4xl font-medium">Reset password</h1>
            <p class="text-slate-500">Fill up the form to reset the password</p>

            <form action="../includes/password_recover/reset_request.inc.php" method="post" class="my-10">
                <div class="flex flex-col space-y-5">
                    <label for="email">
                        <p class="font-medium text-slate-700 pb-2">Email address</p>
                        <input id="email" name="email" type="email" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow" placeholder="Enter email address">
                    </label>
                    <button class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center" name="reset-request-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                        </svg>

                        <span>Find your Password</span>
                    </button>
                    <p class="text-center">Not registered yet? <a href="./Register.php" class="text-indigo-600 font-medium inline-flex space-x-1 items-center"><span>Register now
                            </span><span><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg></span></a></p>
                </div>
            </form>
        </div>
    </div>





    <!------------------------------------------end contaner---------------------------------------------- -->

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
        <?php
        if (isset($_GET["user"])) { ?>
            Swal.fire({
                icon: "error",
                title: "User not found",
                text: "Please change your email !",
            });
        <?php } ?>
        
    </script>

    <!----------------------------- end footer ------------------------------------->


</body>

</html>