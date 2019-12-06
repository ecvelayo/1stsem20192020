<?php
	
	$hostname   = "192.168.0.171";   
    $username   = "bryle";       
    $password   = "trinkle";
    $dbname     = "trinkle";

    // $hostname 	= "192.168.1.8";	
	// $username 	= "flora";		
	// $password 	= "";
	// $dbname 	= "basic";
	
	$conn = mysqli_connect($hostname, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed !!!");
	} 

	$query = "SELECT * FROM log ORDER BY log_id DESC LIMIT 1";
	$result = mysqli_query($conn, $query);

	while($row = mysqli_fetch_array($result)){
		$value = $row;
	}
	
	echo "Soil Moisture: " . $value[1];
	echo "<br>Temperature: " . $value[2];
	echo "<br>Humidity: " . $value[3];
?>