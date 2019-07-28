<?php
	session_start();
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
<h1>Edit Account</h1>
<form>
	Admin Name: <input type="text" size="50" class="AdminInput" required/><br /><br />
	Username: <input type="text" size="50" class="AdminInput" required/> <br /><br />
	Password: <input type="password" size="50" class="AdminInput" required/><br /><br />
	Image:<input type="file" /><br /><br />
	<input type="submit" value="Edit Account" />
</form>
	<?php } ?>