<?php
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
<h1>Edit hostel</h1>
<form action="">
	Hostel name: <input type="text" size="50" class="AdminInput" required/><br /><br />
	Hostel location: <input type="text" size="50" class="AdminInput" required/> <br /><br />
	Hostel gender: <input type="text" size="50" class="AdminInput" required/> <br /><br />
	Hostel city: <input type="text" size="50" class="AdminInput" required/><br /><br />
	Hostel Link: <input type="text" size="50" class="AdminInput" required/><br /><br />
	Hostel map: <input type="text" size="50" class="AdminInput" required/><br /><br />
	Hostel Image:<input type="file" /><br /><br />
	Keywords:<br /> <textarea cols="30" rows="20"></textarea><br /><br />
	<input type="submit" value="Edit hostel" />
</form>
	<?php } ?>