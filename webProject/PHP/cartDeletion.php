<html>
	<head>
		<title>Deletion</title>
	</head>
		<body bgcolor=#00B0F0 text=white>
<?php
session_start();
$id = $_GET['id'];


	//Connect to MySQL Database
			
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	
			
		if(!$conn) {die("Could not connect: " . mysql_error());}

		mysqli_select_db($conn, "cart");

				$query = "DELETE FROM cart WHERE productId='$id';";

				mysqli_query($conn, $query) or die(mysqli_error($conn));
				
				header ("refresh: 0; url=../PHP/cart.php");
			session_destroy();
		mysqli_close($conn);
	
?>