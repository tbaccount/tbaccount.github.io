<html>
	<head>
		<title>Login</title>
	</head>
		<body bgcolor=#00B0F0 text=white>
<?PHP
session_start();

class User
{
	private $email;
	private $password;
	
	public function setUser($email, $password)
	{
		$this->email=$email;
		$this->password=$password;
	}

	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPass()
	{
		return $this->password;
	}

}

	$user = new User();
	$user->setUser("$_POST[email]", "$_POST[psw]");


	$email=$user->getEmail();
	$password=$user->getPass();

	//Connect to MySQL Database

			
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	
			
		if(!$conn) {die("Could not connect: " . mysql_error());}

		mysqli_select_db($conn, "login");

		$_SESSION["email"] = $email;
		echo $_SESSION["email"];
		
	//Complete the task
	
			/*Define a query*/
			$query = "SELECT email, password FROM registration WHERE email='$email';";
			
			/*Execute query*/ /*many records will be excuted so into array*/

			$loginResult = mysqli_query($conn, $query) or die(mysqli_error($conn));

			while($loginRecord = mysqli_fetch_assoc($loginResult)) {
				$v_email = $loginRecord["email"];
				$v_pass = $loginRecord["password"];

				if ($v_email == "$email" && $v_pass == "$password") {
					echo "Login successfully!";
							$query1 = "INSERT INTO login VALUES ('$email', '$password');";
							mysqli_query($conn, $query1) or die(mysqli_error($conn));	
					header( "refresh: 2; url=../Welcome_Page.html" ); 
				} else {
					echo "Login credentials are not correct, please try again...";
					header( "refresh: 2; url=../login.html" ); 
				}
			}

		mysqli_close($conn);
	
?>
	
	</body>
</html>