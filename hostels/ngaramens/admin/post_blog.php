<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<!--<h1>Post in blog</h1><br />
<form action="admin.php?post_blog" method="POST" enctype="multipart/form-data">
	<b>Subject:</b><input type="text" name="subject" class="AdminInput" placeholder="Vacancy title" /><br /><br />
	<b>Post Images:</b><input name="image" type="file" /><br /><br />
	<b>Post Message:</b><br /><textarea cols="30" rows="20" name="message"></textarea><br />
	</b><input type="submit" class="AdminSubmit" name="post" value="Post vacancy"/><br /><br />
</form>-->
<?php
/*include ("db.php");
if(isset($_POST['post'])){
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$image = $_FILE['image']['name'];
	$tmp = $_FILE['image']['tmp_name'];
	move_uploaded_file($tmp, "images/$image");
	$insertBlog = "insert into blog (b_title, b_image, b_message, date) value ('$subject','$image','$message',now())"; 
	$runBlog = mysqli_query($con, $insertBlog);
	if($runBlog){
		echo "<script>alert('You have successfully posted a blog')</script>";
		echo "<script>window.open('admin.php?post_blog','_self')</script>";
	}
}*/
echo "<p style='color:#FF0000; font-size:30px; text-align:center; margin-top:30px;'><i>This page is currently unavailable. It will be activated after full payment of the site!</i></p>";
?>
	<?php } ?>