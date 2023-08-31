<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
			$host="localhost";
			$user="admin";
			$pass="1Tc4oQkulzZG";
			$bdd="219";
			$cnx=mysqli_connect($host,$user,$pass);
			if(!$cnx){
				echo"cannot connect to the server"."</br>";
				exit();
			}
			if (mysqli_select_db($cnx,$bdd)==false){
				echo"Cannot find the data base"."</br>";
				exit();
			}
		?>
	</body>
</html>