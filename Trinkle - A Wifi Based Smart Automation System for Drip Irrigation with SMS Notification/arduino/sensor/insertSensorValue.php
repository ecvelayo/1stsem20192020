<?php
    $hostname   = "192.168.0.171";   
    $username   = "bryle";       
    $password   = "trinkle";
    $dbname     = "trinkle";

    $conn = new mysqli($hostname, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    // date_default_timezone_set('Asia/Singapore');
    // $d = date("Y-m-d");
    // $t = date("H:i:s");

    if(!empty($_POST))
    {
		$moistureVal = $_POST['moisturevalue'];
        $temperatureVal = $_POST['temperaturevalue'];
        $humidityVal = $_POST['humidityvalue'];

	    $sql = "INSERT INTO log (soilmoisture_value,temperature_value,humidity_value) VALUES ('".$moistureVal."',
	    																					  '".$temperatureVal."',
	    																					  '".$humidityVal."')"; 

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	$conn->close();
?>