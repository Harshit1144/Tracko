<?php 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'harshit'); 
define('DB_PASSWORD', 'Harshit@1144'); 
define('DB_NAME', 'tracko');


// Connect with the database 
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
 
// Display error if failed to connect 
if ($db->connect_errno) { 
    echo "Connection to database is failed: ".$db->connect_error;
    exit();
}