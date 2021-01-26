<html>
	<head>
		<title>Registration</title>
	</head>
		<body bgcolor=#00B0F0 text=white>

<?PHP
session_start();

class Customer
{

	private $fName;
	private $lName;
	private $email;
	private $password;
	private $rpsw;
	private $address; 
	
	public function setCustomer($fName, $lName, $email, $password, $rpsw, $address)
	{
		$this->fName=$fName;
		$this->lName=$lName;
		$this->email=$email;
		$this->password=$password;
		$this->rpsw=$rpsw;
		$this->address=$address;
	}

	public function getfName()
	{
		return $this->fName;
	}

	public function getlName()
	{
		return $this->lName;
	}

	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPass()
	{
		return $this->password;
	}

	public function getRpass()
	{
		return $this->rpsw;
	}
	
	public function getaddr()
	{
		return $this->address;
	}	
}

	$customer = new Customer();
	$customer->setCustomer("$_POST[fName]", "$_POST[lName]", "$_POST[email]", "$_POST[password]", "$_POST[rpsw]", "$_POST[address]");

	$_SESSION["email"] = "$_POST[email]";

	$fName=$customer->getfName();
	$lName=$customer->getlName();
	$email=$customer->getEmail();
	$password=$customer->getPass();
	$rpsw=$customer->getRpass();	
	$address=$customer->getaddr();

	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);

	if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
		echo "Password should be at least 6 characters in length and should include at least one upper case letter, one lower case letter one number.";
		header( "refresh: 4; url=../create_account.html" );
		exit;
	}elseif($password!=$rpsw) {
		echo "The entered passwords are not matching, please re-enter...";
		header( "refresh: 2; url=../create_account.html" );
		exit;
		} else {
    
	//Connect to MySQL Database
			
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "qualitysales");	
			
		if(!$conn) {die("Could not connect: " . mysql_error());}

		mysqli_select_db($conn, "registration");

	//Complete the task
	
		$query = "INSERT INTO registration VALUES (DEFAULT, '$fName', '$lName', '$email', '$password', '$address');";

		mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		$query1 = "INSERT INTO login VALUES ('$email', '$password');";

		mysqli_query($conn, $query1) or die(mysqli_error($conn));			
		
		echo "Account successfully created.<br />";
		echo "You are logged in.";

		header( "refresh: 2; url=../Welcome_Page.html" );

		mysqli_close($conn);
	}
?>
	
	</body>
</html>