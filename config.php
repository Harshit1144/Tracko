<?php 
define('DB_HOST', 'HOSTNAME'); 
define('DB_USERNAME', 'USERNAME'); 
define('DB_PASSWORD', 'PASSWORD'); 
define('DB_NAME', 'DBNAME');


// Connect with the database 
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
 
// Display error if failed to connect 
if ($db->connect_errno) { 
    echo "Connection to database is failed: ".$db->connect_error;
    exit();
}
