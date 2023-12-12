<?php
ini_set('display_errors', 1); ini_set('log_errors',1); error_reporting(E_ALL); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();
$db_server = "sql206.infinityfree.com";
$db_user = "if0_35553201";
$db_pass = "jS4FFzcVvx";
$db_name = "if0_35553201_blog";
$conn = "";

// Create connection & check connection
try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch (mysqli_sql_exception) {
    echo "Not connected: ";
}

$sql_create_db = "CREATE DATABASE IF NOT EXISTS if0_35553201_blog";
$req=mysqli_query($conn, $sql_create_db);

// Check if the database is created
if(!$req){
    echo "Error creating database: " . mysqli_error($conn);
}