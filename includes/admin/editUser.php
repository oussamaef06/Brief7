<?php
include "../db.inc.php";
include "adminHead.php";

if(isset($_POST["edit"])){
    $newUsername = $_POST["newUsername"];
    $newEmail = $_POST["newEmail"];
    $phone = $_POST["phone"];
    $picture = $_POST["picture"];
    $newPassword = $_POST["newPassword"];
    $oldUsername = $_POST["username"]; 
    $sql = "UPDATE user SET user_name='$newUsername',user_phone='$phone',
       user_email='$newEmail',user_picture='$picture',
       password='$newPassword' WHERE user_email='$oldUsername'";
    
    if($conn->query($sql)){
      echo("<script>alert('user edited successfully!')</script>") . $oldUsername . "yes";
    }
    else
      echo("<script>alert('something went wrong')</script>");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>edit user</title>
</head>
<body class="">
  <div class="flex justify-center">

    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-[50%]"  method="post">
    
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        email
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Your current eamil">
    </div>

    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="newuserName">
        new username
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newUsername" type="text" name="newUsername" placeholder="new username">
    </div>
    
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
        phone number
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" type="text" name="phone" placeholder="phone">
    </div>

    
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="newEmail">
            new email
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newEmail" type="email" name="newEmail" placeholder="new email">
    </div>
    
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="picture">
        picture
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" type="file" name="picture" placeholder="picture">
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="newPassword">
        new password
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newPassword" type="password" name="newPassword" placeholder="new passwrod">
    </div>

    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="edit" value="edit">
        edit
      </button>
    </div>
</form>
</div>

</body>
</html>