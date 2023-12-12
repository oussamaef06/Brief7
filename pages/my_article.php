<?php include("../includes/db.inc.php");
if (empty($_SESSION["user_id"]) || empty($_SESSION["login"])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/png" href="../pictures/avito.png" />
  <title>Avito</title>
</head>

<style>
  /********** Edit button *****************/

  .Btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 150px;
    height: 46px;
    border: none;
    padding: 0px 20px;
    background-color: rgb(168, 38, 255);
    color: white;
    font-weight: 500;
    cursor: pointer;
    border-radius: 10px;
    box-shadow: 5px 5px 0px rgb(140, 32, 212);
    transition-duration: .3s;
  }

  .svg {
    width: 13px;
    position: absolute;
    right: 0;
    margin-right: 20px;
    fill: white;
    transition-duration: .3s;
  }

  .Btn:hover {
    color: transparent;
  }

  .Btn:hover svg {
    right: 43%;
    margin: 0;
    padding: 0;
    border: none;
    transition-duration: .3s;
  }

  .Btn:active {
    transform: translate(3px, 3px);
    transition-duration: .3s;
    box-shadow: 2px 2px 0px rgb(140, 32, 212);
  }

  /********** delele button *****************/
  .button_delete {
    width: 150px;
    height: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    background: red;
    border: none;
    border-radius: 5px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
    background: #e62222;
  }

  .button_delete,
  .button_delete span {
    transition: 200ms;
  }

  .button_delete .text {
    transform: translateX(35px);
    color: white;
    font-weight: bold;
  }

  .button_delete .icon {
    position: absolute;
    border-left: 1px solid #c41b1b;
    transform: translateX(110px);
    height: 40px;
    width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .button_delete svg {
    width: 15px;
    fill: #eee;
  }

  .button_delete:hover {
    background: #ff3636;
  }

  .button_delete:hover .text {
    color: transparent;
  }

  .button_delete:hover .icon {
    width: 150px;
    border-left: none;
    transform: translateX(0);
  }

  .button_delete:focus {
    outline: none;
  }

  .button_delete:active .icon svg {
    transform: scale(0.8);
  }
</style>

<body class="bg-gray-300" style="background-color: #d5deef;">

  <!-- Navbar -->
  <div id="navbar-container">
    <?php include("../js/navbar.php"); ?>
  </div>
  <?php
  if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $articles = getArticleSpecific($userId, $conn);
  } else {
    exit;
  }
  ?>
  <script src="../js/script.js"></script>
  <!-- End Navbar -->

  <!-- Main Content -->
  <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->


  <section id="container" class="bg-white mb-32 mx-10 rounded-2xl text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-wrap -m-4 js-container">
        <?php
        foreach ($articles as $key => $value) {
          $commentCount = getCommentCount($conn, $value["id_article"]);
          if (!$value["soft_delete"]) {
        ?>

            <div class="p-4 md:w-1/3 draggable" draggable="true">
              <div class="h-[640px] border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                <?php echo '<img src="data:image/png;base64,' . base64_encode($value["article_picture"]) . '" alt="blog" style="filter: invert(0);" class="lg:h-[390px] md:h-36 w-full object-cover object-center"/>'; ?>
                <div class="p-6">
                  <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1"><?php echo $value["category"]; ?></h2>
                  <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?php echo $value["title"]; ?></h1>
                  <p class="leading-relaxed mb-3"><?php echo $value["description"]; ?></p>
                  <div class="flex items-center flex-wrap ">
                    <a href="./article.php?id=<?php echo $value['id_article']; ?>" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
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
                <hr class="w-[350px] ml-4">
                <div class="flex flex-row justify-around mt-4">
                  <a class="button_delete" onclick="ShowDeleteAlert(<?php echo $value['id_article'] ?>)" class="noselect"><span class="text">Delete</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                      </svg></span></a>

                  <a href="./modify_article.php?articleId=<?= $value["id_article"] ?>" onclick="ShowEditeAlert(<?php echo $value['id_article'] ?>)" class="Btn">Edit
                    <svg class="svg" viewBox="0 0 512 512">
                      <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                    </svg>
                  </a>



                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </section>



  <!------------------------------------------end Countainer---------------------------------------------- -->
  <!-----------------------------  Search Results Display  ------------------------------------------------->
  <div id="searchresult"></div>


  <!-- End Main Content -->

  <!-- Footer -->
  <div id="Footer-container"></div>
  <script src="../js/footer.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://daniellaharel.com/raindrops/js/raindrops.js"></script>

  <!-- Footer -->
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
  <!-- End Footer -->

  <!--------------------------------  Search script Start  --------------------------------->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
    //ws = new WebSocket('ws://127.0.0.1:5500/');

    // Wait for the document to be fully loaded
    $(document).ready(function() {
      // When the user types in the input field with ID "live_search"
      $("#live_search").on("input", function() {
        // Get the value of the input
        var input = $(this).val();
        console.log("Input: " + input); // Check if the input is captured

        // Check if the input is not empty
        if (input != "") {
          // Make an AJAX request to "search.php"
          $.ajax({
            url: "../includes/search_my_article.php",
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

    function ShowDeleteAlert(id) {
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
          window.location.href = "http://localhost/Winners_Blog/includes/deleteArticle.php?articleId=" + id;
        }
      });
    }
    <?php if (isset($_GET["article"])) { ?>
      Swal.fire({
        icon: "success",
        title: "Done",
        text: "Article edited successfully!"
      });
    <?php } ?>
    <?php if (isset($_GET["artile"])) { ?>
      Swal.fire({
        icon: "success",
        title: "Done",
        text: "Article deleted successfully!"
      });
    <?php } ?>
    <?php if (isset($_GET["atile"])) { ?>
      Swal.fire({
        icon: "success",
        title: "Done",
        text: "Article deleted successfully!"
      });
    <?php } ?>
  </script>

  <!--------------------------------  Search script End  --------------------------------->

  <script src="../js/drag_drop.js"></script>
</body>

</html>