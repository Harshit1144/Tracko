<?php      
  $db_host="HOSTNAME";
  $db_user="USERNAME";
  $db_password="PASSWORD";
  $db_name="DBNAME";
  
  
  $conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
  if(!$conn){
      die("Connection Failed<br>");
  }
?>  
