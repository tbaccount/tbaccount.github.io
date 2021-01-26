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

			$query1 = "SELECT productName, unitPrice, discountPrice, productImage FROM product WHERE productId='$id';";			
			
			/*Execute query*/ /*many records will be excuted so into array*/

			$pResult = mysqli_query($conn, $query1) or die(mysqli_error($conn));

			while($pRecord = mysqli_fetch_assoc($pResult)) {
				$v_unitPrice = $pRecord["unitPrice"];
				$v_discountPrice = $pRecord["discountPrice"];
				$v_pImage = $pRecord["productImage"];
				$v_pName = $pRecord["productName"];
				$v_subtotal = $v_discountPrice*$_POST["quantity"];
			}				
				
				
			$query2 = "INSERT INTO cart VALUES (DEFAULT, '1', '$id', '$v_pName', '$v_discountPrice', '$v_pImage', '$_POST[quantity]', '$v_subtotal');";
			
			mysqli_query($conn, $query2) or die(mysqli_error($conn));	

				
			header ("refresh: 0; url=../PHP/cart.php"); 
			session_destroy();
		mysqli_close($conn);
	
?>