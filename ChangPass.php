<?PHP
	session_start();
	if(empty($_SESSION['ID']) || empty($_SESSION['NAME']) || empty($_SESSION['SUR_NAME'])){
		echo '<script>window.location = "Login.php";</script>';
	}
	
	$conn = oci_connect("system", "tickey31862", "//localhost/XE");
?>
<style type="text/css">
body,td,th {
	color: #0F0;
	text-align: left;
}
</style>

<h1> Change Password Page </h1>

<?PHP
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$newpass = trim($_POST['Newpassword']);
		$confirm = trim($_POST['confirmP']);
		if($newpass == $confirm ){
		$query = "SELECT * FROM A_LO WHERE USERNAME='$username' and PASSWORD='$password'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row){
			$update = "UPDATE A_LO SET PASSWORD = '$newpass' WHERE USERNAME='$username' ";
			$parseRequest1 = oci_parse($conn, $update);
		    oci_execute($parseRequest1);
			echo "Password Is Changed ";
			
			
		}
		else{
			 echo "Username or Password is incorrect.<br>";
			}
		}
		else{
			echo "The confirm password is not correct.<br>";
			}
     	};

?>

<?PHP
	if(isset($_POST['back'])){
		echo '<script>window.location = "MemberPage.php";</script>';
	}
?>

<?PHP
	//echo "ID : ".$_SESSION['ID']."<br>";
	//echo "NAME : ".$_SESSION['NAME']."<br>";
	//echo "SUR_NAME : ".$_SESSION['SUR_NAME']."<br>";
	
	echo "<a href='Logout.php'>Logout</a>";
?>
<style type="text/css">
body,td,th {
	font-size: 24px;
	color: #0F0;
	text-align: center;
}
</style>


<form action='ChangPass.php' method='post'>
	<p> Username 
	  <input name='username' type='input'><br>
	Old Password
	<input name='password' type='password'><br>
	New Password
	<input name='Newpassword' type='password' />
	<br>
    Confirm Password
	<input name='confirmP' type='password'><br>
	</p>
    <input name='submit' type='submit' value='Change' />
    
    <input name='back' type='submit' value='Back' />
</form>

