<?php
include("db.inc.php");

// Select the database
mysqli_select_db($conn, 'blog');


// SQL to create table Role
$sql_create_table_role = "
CREATE TABLE IF NOT EXISTS Role (
    id_role INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_title VARCHAR(50) NOT NULL
    
)";

// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_role)) {
    echo "Table Role created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}


// SQL to create table user
$sql_create_table_user = "
CREATE TABLE IF NOT EXISTS User (
    id_user INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    user_phone VARCHAR(30) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_picture LONGBLOB NOT NULL, 
    city VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    soft_delete TIMESTAMP NULL DEFAULT NULL, 
    UNIQUE KEY unique_user_email (user_email),
    role_id INT(6) UNSIGNED,
    FOREIGN KEY (role_id) REFERENCES Role(id_role) ON UPDATE CASCADE ON DELETE CASCADE

)";

// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_user)) {
    echo "Table User created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}



// SQL to create table category
$sql_create_table_category = "
CREATE TABLE IF NOT EXISTS Category (
    id_category INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100) NOT NULL
)";

// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_category)) {
    echo "Table Category created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

// SQL to create table article
$sql_create_table_article = "
CREATE TABLE IF NOT EXISTS Article (
    id_article INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(500) NOT NULL,
    article_picture LONGBLOB NOT NULL,
    article_date VARCHAR(50) NOT NULL,
    creator_id INT(6) UNSIGNED,
    soft_delete TIMESTAMP NULL DEFAULT NULL, 
    FOREIGN KEY (creator_id) REFERENCES User(id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    category_id INT(6) UNSIGNED,
    FOREIGN KEY (category_id) REFERENCES Category(id_category) ON UPDATE CASCADE ON DELETE CASCADE
    
)";


// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_article)) {
    echo "Table Article created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}



// SQL to create table Comment
$sql_create_table_comment = "
CREATE TABLE IF NOT EXISTS Comment (
    id_cmt INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    text_cmt VARCHAR(500) NOT NULL,
    date_cmt VARCHAR(50) NOT NULL,
    creator_id INT(6) UNSIGNED,
    soft_delete TIMESTAMP NULL DEFAULT NULL, 
    FOREIGN KEY (creator_id) REFERENCES User(id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    article_id INT(6) UNSIGNED,
    FOREIGN KEY (article_id) REFERENCES Article(id_article) ON UPDATE CASCADE ON DELETE CASCADE
)";

// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_comment)) {
    echo "Table Comment created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}




// SQL to create table Permission
$sql_create_table_permission = "
CREATE TABLE IF NOT EXISTS Permission (
    id_permission INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    permission_action VARCHAR(100) NOT NULL,
    permission_module VARCHAR(100) NOT NULL,
    user_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES User(id_user) ON UPDATE CASCADE ON DELETE CASCADE
)";


// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_permission)) {
    echo "Table Permission created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}


// SQL to create table associative User Permission
$sql_create_table_role_permission = "
CREATE TABLE IF NOT EXISTS Role_Permission (
    id_role INT(6) UNSIGNED,
    id_permission INT(6) UNSIGNED,
    PRIMARY KEY (id_role, id_permission),
    INDEX (id_role),
    INDEX (id_permission),
    FOREIGN KEY (id_role) REFERENCES Role(id_role) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_permission) REFERENCES Permission(id_permission) ON UPDATE CASCADE ON DELETE CASCADE
)";

// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_role_permission)) {
    echo "Table Role_Permission created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

// SQL to create table PasswordRecovery
$sql_create_table_password_recovery = "
CREATE TABLE IF NOT EXISTS PasswordRecovery (
    id_pwd INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pwd_reset_email VARCHAR(100) NOT NULL,
    pwd_reset_selector VARCHAR(50) NOT NULL,
    pwd_reset_token TEXT NOT NULL,
    pwd_reset_expires TEXT NOT NULL, 
    user_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES User(id_user)  ON UPDATE CASCADE ON DELETE CASCADE
)";

// Execute the SQL query to create the table
if (mysqli_query($conn, $sql_create_table_password_recovery)) {
    echo "Table PasswordRecovery created successfully" . " <br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

// SQL to create article view
$sql_create_article_view = "CREATE VIEW article_view AS
SELECT a.id_article, a.title, a.description, a.article_picture, a.article_date, a.creator_id, a.soft_delete,
       c.id_category, c.category
FROM Article a
LEFT JOIN Category c ON a.category_id = c.id_category";

// Execute the SQL query to create the view
if (mysqli_query($conn, $sql_create_article_view)) {
    echo "View article created successfully" . " <br>";
} else {
    echo "Error creating view: " . mysqli_error($conn) . " <br>";
}

// SQL to create date trigger
$sql_create_date_trigger = "CREATE TRIGGER set_creation_date BEFORE INSERT ON article FOR EACH ROW
SET NEW.article_date = DATE_FORMAT(NOW(), '%M %e, %Y')";

// Execute the SQL query to create the trigger
if (mysqli_query($conn, $sql_create_date_trigger)) {
    echo "trigger created successfully" . " <br>";
} else {
    echo "Error creating trigger: " . mysqli_error($conn) . " <br>";
}