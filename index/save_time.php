<?php
	//print("Saving..." . $_POST['hrs'] . ":" . $_POST['mins'] . ":" . $_POST['secs']);
	$host = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "timer" ;
		$database_connection = mysqli_connect($host,$username,'',$dbname) or die("could not connect 2 database :C"); 
		mysqli_set_charset($database_connection, "utf8") ;
		$res = mysqli_query($database_connection,"SELECT * FROM timertable ORDER BY id DESC LIMIT 1");
		while($row = mysqli_fetch_array($res))
		{
			$lastdate = $row[1];
			$last_time = $row[2];
		}
		
		
		
		//print( $last_seconds . ":" .$last_minutes . ":" . $last_hours);
		//print($_POST["_time"]);
		$newtime = (int)$_POST["_time"];
		$time_to_save = $last_time + $newtime;
		$query = "UPDATE timertable SET przepracowany_czas=".$time_to_save." WHERE data='".$_POST['_date'] . "'";
		mysqli_query($database_connection,$query) or die("couldn't put the new time in da database :c -> ".$query);
		print("SAVED!");
		mysqli_close($database_connection);
?>