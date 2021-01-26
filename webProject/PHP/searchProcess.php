<html>
	<head>
		<title>Search</title>
	</head>
		<body bgcolor=#00B0F0 text=white>
<?PHP

class Search {

	private $searchItem;

	public function setSearch($searchItem)
	{
		$this->searchItem=$searchItem;
	}

	public function getSearch()
	{
		return $this->searchItem;
	}
	
}

	$search = New Search();
	$search->setSearch("$_POST[searchItem]");

	$searchString=$search->getSearch();
	
	//Connect to MySQL Database
			
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	
			
		if(!$conn) {die("Could not connect: " . mysql_error());}

		mysqli_select_db($conn, "product");

	//Complete the task

			/*Define a query*/
			$query = "SELECT * FROM product WHERE productName LIKE '%$_POST[searchItem]%';";
			
			/*Execute query*/ /*many records will be excuted so into array*/

			$searchResult = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			if (mysqli_num_rows($searchResult)==0) {
					echo "Not found...";
					header( "refresh: 2; url=../category_home.html" ); 
			} else {

			while($searchRecord = mysqli_fetch_assoc($searchResult)) {
				$v_productName = $searchRecord["productName"];
				$v_unitPrice = $searchRecord["unitPrice"];
				$v_discountPrice = $searchRecord["discountPrice"];
				$v_img = $searchRecord["productImage"];	

					echo "<a href=\"../product"."$_POST[searchItem]".".html\">".$v_productName."<br />"."<img src=\"../img/product/".$v_img."\"></ a><br />";

				/*	header ("Location: ../product"."$_POST[searchItem]".".html");*/
				}
			}

		mysqli_close($conn);

?>



		</body>
</html>