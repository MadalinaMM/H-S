<?php

@ini_set("display_errors","1");

echo "Andrei";

if(isset($_POST['data']) && $_POST['data'] != 0){
	echo "Hello";
	$data1 = $_POST['data'];
	echo $data1;
	
	$con = mysql_connect("192.168.2.102","root","root");
	if(!$con) die('Could not connect to database: ' . mysql_error());
	
	$selected = mysql_select_db("data",$con);
	if(!$selected) die('Could not select database: ' . mysql_error());
	
	$sql = "INSERT INTO data(data1) VALUES($data1)";
	if(!mysql_query($sql,$con)) die('Insert errorL ' . mysql_error());
	echo "Inserted correctly - 1 record added \n";
	
	mysql_close($con);
}

else {
	echo "Data received from Aduino:<br /><pre>";
	print_r($_REQUEST);
	echo "</pre>";
}

?>


