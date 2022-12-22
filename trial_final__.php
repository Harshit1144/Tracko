<?php
$db_host="p3nlmysql11plsk.secureserver.net:3306";
$db_user="forestfiresystem";
$db_password="Fsystem123*";
$db_name="forestfiresystem";

$lat=$_GET['lat'];
$lng=$_GET['lng'];
$truck1=$_GET['truckid'];
if($lat=='0.0000'&& $lng=='0.0000'){
    exit("Invalid Data");
}
else{
echo $lat.$lng.$truck1;

$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
if(!$conn){
    die("Connection Failed<br>");
}
echo("Connection success<br>");
$sql = "select routeid from truckload where  id =(select max(id) from truckload where truck_no ='$truck1') ";
$result =mysqli_query($conn,$sql);
$res=mysqli_fetch_array($result);
echo $res[0]."<br>";



$sql = "SELECT * FROM routes WHERE lat=$lat AND lng=$lng and routeid ='$res[0]'";
$result= mysqli_query($conn,$sql);
$row=mysqli_num_rows($result);
echo("$row<br>");

$sql="select CONVERT_TZ(CURRENT_TIMESTAMP,'+00:00','+12:30');";
$result =mysqli_query($conn,$sql);
$daterows= mysqli_fetch_array($result);


if($row>=1)
{
    $msg1="On Route";
    echo("$msg1<br>");
    $sql1 = "INSERT INTO live(truckid,lat,lng,msg,date_time) VALUES('$truck1','$lat','$lng','$msg1','$daterows[0]') ";
    $result1= mysqli_query($conn,$sql1);
    echo("$result1");
}
else{
    
    $msg2="Off Route";
    echo("$msg2<br>");
    $sql = "INSERT INTO live(truckid,lat,lng,msg,date_time) VALUES('$truck1','$lat','$lng','$msg2','$daterows[0]') ";
    $result2= mysqli_query($conn,$sql);
    echo("$result2");
}
}
?>