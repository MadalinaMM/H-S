<?php
	@ini_set("display_errors","1");
	$link = mysql_connect('localhost', 'root', 'root');
	if (!$link) {
	    die('Eșec la conectare: ' . mysql_error());
	}
	mysql_select_db('data', $link);
	if(isset($_GET['data']) && isset($_GET['type'])) {
		$data = mysql_escape_string($_GET['data']);
		$type = mysql_escape_string($_GET['type']);
		mysql_query("INSERT INTO data (data, type) VALUES ('".$data."', '".$type."')") or die(mysql_error());
		echo "success";

	} 
	else {
		if(isset($_GET['type'])) {
			$type = mysql_real_escape_string($_GET['type']);
			$select = "SELECT * FROM data WHERE type = '".$type."' ORDER BY id DESC LIMIT 1 ";
		} else {
			$select = "SELECT data.* FROM (SELECT * FROM data ORDER BY id DESC) AS data GROUP BY data.type"; 
		}
		$query = mysql_query($select) or die(mysql_error());
		$result = array();	
		while($row = mysql_fetch_array($query)) {
			$result[] = array('data'=>$row['data'], 'type'=>$row['type'], 'id'=>$row['id']);
		}
		echo json_encode($result);
	}

	mysql_close($link);

?>