<html>
	<head>
		<title>Cart</title>
	</head>
		<body bgcolor=#00B0F0 text=white>
<?PHP
session_start();

	//Connect to MySQL Database
			
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	
			
		if(!$conn) {die("Could not connect: " . mysql_error());}

		mysqli_select_db($conn, "cart");

	//Complete the task
	
			/*Define a query*/
			$query = "SELECT productName, unitPrice, discountPrice, productImage FROM product WHERE productId='$_POST[productId]';";
			
			/*Execute query*/ /*many records will be excuted so into array*/

			$cartResult = mysqli_query($conn, $query) or die(mysqli_error($conn));

			while($cartRecord = mysqli_fetch_assoc($cartResult)) {
				
				$v_unitPrice = $cartRecord["unitPrice"];
				$v_discountPrice = $cartRecord["discountPrice"];
				$v_pImage = $cartRecord["productImage"];
				$v_pName = $cartRecord["productName"];
				$v_subtotal = $v_discountPrice*$_POST["quantity"];

			/*	echo "The unitPrice is: ".$v_unitPrice."<br />";
				echo "The discountPrice is: ".$v_discountPrice."<br />";				
				echo "The subtotal is: ".$v_subtotal;*/
			}

			$query1 = "INSERT INTO cart VALUES (DEFAULT, '$_POST[cartId]', '$_POST[productId]', '$v_pName', '$v_discountPrice', '$v_pImage', '$_POST[quantity]', '$v_subtotal');";

			mysqli_query($conn, $query1) or die(mysqli_error($conn));

			header( "refresh: 0; url=../php/cart.php" ); 

		mysqli_close($conn);
	
?>
	
	</body>
</html>