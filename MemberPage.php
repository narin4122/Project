<?PHP
	session_start();
	if(empty($_SESSION['ID']) || empty($_SESSION['NAME']) || empty($_SESSION['SUR_NAME'])){
		echo '<script>window.location = "Login.php";</script>';
	}
?><body bgcolor="#FFFFFF" text="#FF0000">
<h1>Member page </h1>
<hr>
<?PHP
	echo "ID : ".$_SESSION['ID']."<br>";
	echo "NAME : ".$_SESSION['NAME']."<br>";
	echo "SUR_NAME : ".$_SESSION['SUR_NAME']."<br>";
	echo "<a href='Logout.php'>Logout</a>";
?>

<?PHP
	if(isset($_POST['change'])){
		
	echo '<script>window.location = "ChangPass.php";</script>';
	}
?>
<form action='MemberPage.php' method='post'>
<p><strong>Change Password</strong>
<p>
<input type="submit" name="change" id="change" value="Click" />
  
</form>
