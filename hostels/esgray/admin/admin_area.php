<?php
	error_reporting(E_ALL);
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<div id="adminHeader">
	<ul>
		<li><a href="edit_account">Edit account</a></li>
		<li><a href="add_admin">Add admin</a></li>
		<li><a href="change_room">Change rooms image</a></li>
	</ul>
</div>
<div id="adminArea">
	
</div>
<?php } ?> 