<?php
	session_start();
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
<h1>Add Locality</h1>
<form>
	Locality Name: <input type="text" size="50" class="AdminInput" required/><br /><br />
	<input type="submit" value="Add Locality" />
</form>
	<?php } ?>