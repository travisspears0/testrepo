<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>timer!</title>
                   <script type="text/javascript" src="jquery.js"></script>
                   <script type="text/javascript" src="scripts.js"></script>
                   <link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	<body>
	<?php
		$lastdate =null;
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
		//sprawdza czy dzisiejsza data jest w bazie, jak nie to ja wpisuje:
		if($lastdate != date("Y-m-d"))
		{
			//nie bylo
			mysqli_query($database_connection,"INSERT INTO timertable(id,data,przepracowany_czas) VALUES (NULL,'".date('Y-m-d')."','0')") or die("couldn't put today's date in the database :C");
			
			print("Sorry, I had to put today's date in the database. Please, reload this page :)");
		}
		else{
		$lasthours= floor($last_time / 3600);
		$lastminutes= (floor($last_time / 60)) % 60;
		$lastseconds= $last_time % 60;
	?>
	
	
	
		<div class="container">
			<a href="history.php">Zobacz historie</a>
		</div>
		<br />
		<div class="container">
			Dzisiejsza data: <font color="FFFFFF"><div id="tomorrows_date"><?php echo $lastdate; ?></div></font><br />
			Dzis przepracowales:  <font color="FFFFFF"><?php print( $lasthours . ":". $lastminutes . ":" . $lastseconds ); ?></font><br />
			Licznik: 
			<div id="licznik_div">
				<table>
					<tr><td>HOURS</td>			<td><div id="hours_div"></div></td>			</tr>
					<tr><td>MINUTES</td>		<td><div id="minutes_div"></div></td>		</tr>
					<tr><td>SECONDZ</td>		<td><div id="seconds_div"></div></td>		</tr>
				</table>
			</div>
			<input type="button" style="display:none"></input>
			<input type="button" value="START" id="timer_startstop" class="btn"></input>
		</div>
		
		
		<?php
			}
			//zamyka polaczenie
			mysqli_close($database_connection);
		?>
	</body>

</html>