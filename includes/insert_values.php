<?php
include("db.inc.php");
mysqli_select_db($conn, 'blog');


//insert catrgories into category table
$sql_category_values = "
INSERT INTO Category (category) VALUES
('INFORMATIQUE ET MULTIMEDIA'),
('IMMOBILIER'),
('VEHICULES'),
('POUR LA MAISON ET JARDIN'),
('LOISIRS ET DIVERTISSEMENT')";

// Assuming $conn is your database connection variable
$req_category = mysqli_query($conn, $sql_category_values);

if ($req_category) {
    echo "Values inserted successfully." . "<br>";
} else {
    echo "Error: " . mysqli_error($conn);
}



// insert roles into role table
$sql_role_values = "INSERT IGNORE INTO ROLE (role_title) VALUES 
('Admin'),
('Annoncer'),
('Viewer')";
$req_role = mysqli_query($conn, $sql_role_values);

if (!$req_role) {
    echo "Error: " . mysqli_error($conn) . "<br>";
} else {
    echo "Roles inserted successfully." . "<br>";
}

// insert permissions
$sql_permission_values = "
INSERT INTO Permission(permission_action, permission_module) VALUES 
('get users', 'user table'),
('update users', 'user table'),
('delete users', 'user table')";
$req_permissions = mysqli_query($conn, $sql_permission_values);

if (!$req_permissions) {
    echo "Error: " . mysqli_error($conn) . "<br>";
} else {
    echo "Permissions inserted successfully." . "<br>";
}

$hashedPassword = password_hash("admin", PASSWORD_DEFAULT);

$sql_admin = "INSERT INTO user (user_name, user_email, password, user_phone, user_picture, city) VALUES ('admin', 'admin', '$hashedPassword', 000, 'sat', 'rabat')";

$req_admin = mysqli_query($conn, $sql_admin);

if (!$req_admin) {
    echo "Error: " . mysqli_error($conn) . "<br>";
} else {
    echo "admin credentials inserted successfully." . "<br>";}