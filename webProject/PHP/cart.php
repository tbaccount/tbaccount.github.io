<?PHP
	session_start();

	//Connect to MySQL Database
			
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
				Shopping Cart
		</title>
	
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../css/cart.css" rel="stylesheet" type="text/css" />	

	</head>
		<body bgcolor=#00B0F0 text=white>
			<img src="../img/titlepicture.jpg" width=100% height=5%/>
			<a href="../login.html">
			<img src="../img/account.jpg" width="10%" height="10%" class="pic2"/></a>
			<a href="../Welcome_Page.html">
			<img src="../img/back.jpg" alt="back_to_welcome" align=right width=10% height=10%/></a>
			
			<?php			
			echo	"<table class='productList'style='width: 100%;'>";
			echo 	"<caption><h2>YOU HAVE SELECTED:</h2></caption>";								
								
			echo	"<thead>";	
			echo		"<tr>";
			echo			"<th>Product</th>";
			echo			"<th>Price</th>";
			echo			"<th>Quantity</th>";
			echo			"<th>Subtotal</th>";
			echo			"<th>Clear</th>";
			echo		"</tr>";
			echo	"</thead>";
			
			$total = 0;
				
			$query = "SELECT Id, productId, productName, discountPrice, productImage, SUM(quantity) AS sum FROM cart GROUP BY productId ORDER BY cartId;";
			$pRecord = mysqli_query($conn, $query);
			if(mysqli_num_rows($pRecord) > 0)
			{
				while($row = mysqli_fetch_assoc($pRecord))
					{				
						$v_productId = $row["productId"];
						$v_productName = $row["productName"];
						$v_discountPrice = $row["discountPrice"];
						$v_img = $row["productImage"];
						$v_quantity = $row["sum"];
						$v_subtotal = $v_discountPrice*$v_quantity;	

						$total = $total + $v_subtotal;

					$array = array(
								array('id'=>$row["productId"], 'name'=>$row["productName"], 'price'=>$row["discountPrice"], 'qty'=>$row['sum'], 'img'=>$row["productImage"])
									);

					foreach ($array as $key=>$value)
					{								
						echo "<tbody>";
						echo "<tr>";
						echo "<td><img src='../img/product/".$value['img']."' alt='Product' width='170' height='100' align='bottom'><br />".$value['name']."</td>";
						echo "<td>".$value['price']."</td>";
						echo "<td>You have: ".$value['qty']."<br /><br /><form action='../PHP/cartUpdate.php?id=".$value['id']."' method='post'><input style='width: 61px;' type='number' step='1' min='1' max='99' name='quantity' value='1'><br /><input type='submit' name='update' value='UPDATE'></form>"."</td>";
						echo "<td>".$value['qty']*$value['price']."</td>";
						echo "<td><a href='../PHP/cartDeletion.php?id=".$value['id']."'>REMOVE</a></td>";
						echo "</tr>";
						echo "</tbody>";	
							}	
					}	echo "</table>";		
				}
			?>

			<?php
				$orderId = rand(100, 999); 
			?>
			<table class="billing_payment" rules="rows" style="margin:auto;">
				<thead>	
					<tr>
						<th><h2>Order ID: </h2></th>
						<td style="text-align: center;"><h2><?php echo $orderId?></h2></td>
					</tr>
				</thead>
				<body>
					<tr>
						<th><strong><p>Final Payment:</p></strong></th>                
						<td style="text-align: center;">
						<ul style="font-size: 20px">
							<li><strong>&dollar;<?php echo number_format($total, 2); ?></strong></li>
						</ul>
						</td>
					</tr>
				</body>
			</table>
			<br />
			<h1><center><a href="../checkout.html"><font color=gold>Checkout</font></a></center></h1>
			<br /><br />
		<hr />
		<p style="text-align: center;">
		QualitySale &#9991; 404 Commercial Drive &#9993; Montreal, QC H4A5T6 &#9743; (800) 567-1234</p>
		</body>
		<?php
			mysqli_close($conn);
		?>
<html>
