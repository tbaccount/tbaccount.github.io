<html>
	<head>
		<title>Logout</title>
	</head>
		<body bgcolor=#00B0F0 text=white>
		<?php
		// Initialize the session
		session_start();
	
				$dbhost = "localhost";
				$dbuser = "root";
				$dbpass = "";
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	
					
				$email1=$_SESSION["email"]; 	
					
				if(!$conn) {die("Could not connect: " . mysql_error());}

				mysqli_select_db($conn, "login"); 
					
					$query = "DELETE FROM login WHERE email='$email1';";
					
					/*Execute query*/

					mysqli_query($conn, $query) or die(mysqli_error($conn));
					
					mysqli_close($conn);
		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
			echo "You have logged out!";
		// Redirect to login page
			header( "refresh: 2; url=../Welcome_page.html" ); 
		exit;
		?>
		</body>
</html>