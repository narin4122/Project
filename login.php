<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "tickey31862", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>
<style type="text/css">
body,td,th {
	font-size: 36px;
	color: #00F;
	text-align: center;
}
</style>
 
   <h1><strong> Login form </strong></h1>
<hr>

<?PHP
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$logo = trim($_POST['logo']);
		if($logo == 4122){
		$query = "SELECT * FROM A_LO WHERE USERNAME='$username' and PASSWORD='$password'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row){
			$_SESSION['ID'] = $row['ID'];
			$_SESSION['NAME'] = $row['NAME'];
			$_SESSION['SUR_NAME'] = $row['SUR_NAME'];
			
			
			echo '<script>window.location = "MemberPage.php";</script>';
		}else{
			echo "Login fail.";
		}
		}
		else{
			echo "Login fail.";
			}
	};
	oci_close($conn);
?>

<form action='login.php' method='post'>
	<p>Username 
	<input name='username' type='input'><br>
	Password
	<input name='password' type='password'><br>
    </p>
  <p>กรุณากรอกตัวเลข 4122 ลงใน ฟอร์มข้างล่าง</p>
  <p>
    <label for="logo">กรอกตัวเลข</label>
    <input type="input" name="logo" id="logo" />
  </p>
  <input name='submit' type='submit' value='Login' />
</form>

