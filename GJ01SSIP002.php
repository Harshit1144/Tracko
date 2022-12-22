<?php
$db_host="p3nlmysql11plsk.secureserver.net:3306";
$db_user="forestfiresystem";
$db_password="Fsystem123*";
$db_name="forestfiresystem";


$conn=mysqli_connect($db_host,$db_user,$db_password,$db_name);
if(!$conn){
    die("Connection Failed<br>");
}
// echo("Connection success<br>");
$sql = "SELECT * FROM live where srno =(select max(srno) from live where truckid='GJ01SSIP002')";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$id= ($row['truckid']);
$lat= ($row['lat']);
$lng= ($row['lng']);
$msg= ($row['msg']);
$time= ($row['date_time']);


$sql = "SELECT lat,lng from routes where routeid='rcti'";
$res= mysqli_query($conn,$sql);
$mainres=mysqli_fetch_all($res);

$myArray = json_encode($mainres);
?>
<!DOCTYPE html>
<html>
<meta http-equiv="refresh" content="10">

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
    <table class="fl-table" border="2">
<thead>
	<tr>
			<th>Latitude
			<th>Longitude
			<th>status
            <th>date&time    
			<th>Link[To go to last location]

	</tr>
</thead>
<tbody>
	<tr>
			<td><?php echo $lat ?>
			<td><?php echo $lng ?>
			<td><?php echo trim($msg,"."); ?>
            <td><?php echo $time;?>
			<td><a href="https://www.google.com/maps/search/?api=1&query=<?php echo $lat ?>,<?php echo $lng ?>">click here to access last location</a>
	</tr>
</tbody>
	</table>
	<hr style="height:2px;border-width:0;color:gray;background-color:gray">


	<div id="map" style="width:100%; height: 100vh"></div>
	   <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<!-- <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->
        

	<script>
        // import {antPath} from leaflet-ant-path;
		var map = L.map('map').setView([<?php echo $lat ?>,<?php echo $lng?>],15);
		mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
		var popup = L.popup()
            .setContent("<?php echo"Latitude=".$lat." & "."Longitude=".$lng."<br>".trim($msg,".")."<br>".$time;?>");


		var marker = L.marker([<?php echo $lat ?>,<?php echo $lng?>]).addTo(map);
        marker.bindPopup(popup).openPopup();
        var latlngs = [<?php echo str_replace('"','',$myArray);?>
//[[23.12247,72.565902],[23.122291,72.565895],[23.122285,72.565872],[23.12227,72.565849],[23.122264,72.565841],[23.122278,72.565849],[23.12228,72.565803],[23.122283,72.56578],[23.122287,72.56575],[23.122285,72.565765],[23.122291,72.565773],[23.12231,72.565757],[23.12235,72.565734],[23.12239,72.565727],[23.122398,72.565734],[23.122409,72.56575],[23.122436,72.565757],[23.122459,72.565734],[23.122474,72.565727],[23.122491,72.565719],[23.122493,72.565734],[23.122503,72.565765],[23.122549,72.565765],[23.122537,72.565773],[23.12255,72.565757],[23.122562,72.565734],[23.122579,72.565734],[23.122596,72.565742],[23.122613,72.565757],[23.122619,72.565765],[23.122636,72.565773],[23.122661,72.565765],[23.122671,72.56578],[23.122692,72.565757],[23.122695,72.565734],[23.12272,72.565734],[23.122732,72.565734],[23.122741,72.565727],[23.12276,72.565734],[23.122772,72.56575],[23.122797,72.565734],[23.122798,72.565727],[23.122823,72.565742],[23.122867,72.56594],[23.122875,72.565963],[23.122877,72.565986],[23.122875,72.566009],[23.122877,72.566024],[23.122882,72.56604],[23.122884,72.566055],[23.122888,72.566062],[23.122894,72.566078],[23.122896,72.566093],[23.1229,72.566139],[23.12289,72.566154],[23.122888,72.566177],[23.122888,72.56623],[23.122879,72.56623],[23.122863,72.566238],[23.122848,72.566261],[23.122838,72.566284],[23.122825,72.566284],[23.122787,72.566268],[23.122766,72.566276],[23.122722,72.566291],[23.12269,72.566314],[23.122663,72.566337],[23.122644,72.566345],[23.122623,72.56636],[23.122613,72.56636],[23.122591,72.566368],[23.122583,72.566368],[23.122571,72.566375],[23.12256,72.566368],[23.12255,72.566368],[23.122537,72.566345],[23.122526,72.566322],[23.12252,72.566299],[23.122531,72.566291],[23.122533,72.566268],[23.12252,72.566238],[23.122514,72.56623],[23.122497,72.566238],[23.122489,72.566261],[23.122478,72.566291],[23.12247,72.566322],[23.122461,72.566322],[23.122446,72.566314],[23.122426,72.566291],[23.122411,72.566268],[23.122404,72.566246],[23.122373,72.566169],[23.122373,72.566123],[23.122381,72.566078],[23.122381,72.566047],[23.122375,72.566024],[23.122381,72.566009],[23.122381,72.565994],[23.122386,72.565994],[23.122385,72.565994],[23.122365,72.565971],[23.122371,72.565963],[23.12239,72.565956],[23.122388,72.565963],[23.122398,72.565963],[23.122407,72.565956],[23.122406,72.565956],[23.122413,72.56594],[23.122411,72.56594],[23.122413,72.565933],[23.122417,72.56594],[23.122423,72.565933],[23.122425,72.565925],[23.12243,72.56591],[23.122444,72.56591],[23.122447,72.565902],[23.122455,72.565902],[23.122465,72.565895],[23.12247,72.565902],[23.122488,72.565925],[23.122507,72.565948],[23.12251,72.565956],[23.122516,72.565956],[23.122522,72.565956],[23.122524,72.565956],[23.122524,72.565948],[23.122518,72.565933],[23.12252,72.565925],[23.122539,72.56591]]
  ];

var polyline = L.polyline(latlngs, {color: 'blue',"weight":5}).addTo(map);

// zoom the map to the polyline
map.fitBounds(polyline.getBounds());
</script>


</body>

</html>