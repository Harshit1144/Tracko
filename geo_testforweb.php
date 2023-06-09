<?php
$db_host="HOSTNAME";
$db_user="USERNAME";
$db_password="PASSWORD*";
$db_name="DBNAME";


$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
if(!$conn){
    die("Connection Failed<br>");
}
// echo("Connection success<br>");
$sql = "SELECT * FROM live where srno =(select max(srno) from live where truckid='GJ01SSIP001')";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$id= ($row['truckid']);
$lat= ($row['lat']);
$lng= ($row['lng']);
$msg= ($row['msg']);
$time= ($row['date_time']);
$sql = "SELECT * FROM live where srno =(select max(srno) from live where truckid='GJ01SSIP002')";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$id1= ($row['truckid']);
$lat1= ($row['lat']);
$lng1= ($row['lng']);
$msg1= ($row['msg']);
$time1= ($row['date_time']);

?>
<!DOCTYPE html>
<html>
<meta http-equiv="refresh" content="20">

<head>
	<title>Geolocation</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
	    

	<style>
		body {
			margin: 0;
			padding: 0;
		}
		 .table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

		
	</style>

</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse" style="height:80px">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="geo_testforweb.php"><img src="tracko_logo.png" width=100 height=70 style="padding-bottom: 15px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="font-size :21px;padding: 15px;">
        <li class="active"><a href="geo_testforweb.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Devices <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="GJ01SSIP001.php">GJ01SSIP001</a></li>
            <li><a href="GJ01SSIP002.php">GJ01SSIP002</a></li>
          </ul>
        </li>
        <li><a href="map.html">Route Planner</a></li>
        <li><a href="dataentry.php">Data Entry</a></li>
      </ul>
    </div>
  </div>
</nav>  
</body>
</html>

<body>
    <div class="container">
<center></center></div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray">

<div class="table-wrapper">
    <!-- <p>The page will refresh in:-
 <img src="timer.gif"alt="timer" height="150" width="150"></p> -->


	<div id="map" style="width:100%; height: 100vh"></div>
	   <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

	<script>
        // import {antPath} from leaflet-ant-path;
		var map = L.map('map').setView([<?php echo $lat ?>,<?php echo $lng?>],10);
		mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
		var popup = L.popup()
            .setContent("<?php echo"Latitude=".$lat." & "."Longitude=".$lng."<br>".trim($msg,".");?>");


		var marker = L.marker([<?php echo $lat ?>,<?php echo $lng?>]).addTo(map);
        marker.bindPopup(popup).openPopup();
		
        var popup1 = L.popup()
            .setContent("<?php echo"Latitude=".$lat1." & "."Longitude=".$lng1."<br>".trim($msg1,".");?>");


		var marker1 = L.marker([<?php echo $lat1 ?>,<?php echo $lng1?>]).addTo(map);
        marker1.bindPopup(popup1).openPopup();
</script>


</body>

</html>
