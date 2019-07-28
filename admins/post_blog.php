<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
<div id="blog_tabs">
	<ul>
		<li><a href="#post_blog">Post blog</a></li>
		<li><a href="#view_blogs">View blogs</a></li>
	</ul>
	<div id="post_blog">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h1>Post in blog</h1><br />
				<form action="admin.php?post_blog" method="POST" enctype="multipart/form-data">
					<b>Subject:</b><input type="text" name="subject" class="form-control" placeholder="Blog title" /><br /><br />
					<b>Post Images:</b><input name="image" type="file" /><br /><br />
					<b>Post Message:</b><br /><textarea cols="30" rows="20" name="message"></textarea><br />
					</b><input type="submit" class="btn btn-primary form-control" name="post" value="Post vacancy"/><br /><br />
				</form>
			</div>
		</div>
		<?php
		if(isset($_POST['post'])){
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$image = $_FILES['image']['name'];
			$tmp = $_FILES['image']['tmp_name'];
			$hostel = $_SESSION['hostel'];
			move_uploaded_file($tmp, "images/".$image);
			$insertBlog = "insert into blog (b_title, b_image, b_message,host_id,date) value ('$subject','$image','$message','$hostel',now())"; 
			$runBlog = mysqli_query($con, $insertBlog);
			if($runBlog){
				echo "<script>alert('You have successfully posted a blog')</script>";
				echo "<script>window.open('admin.php?post_blog','_self')</script>";
			}
		}
		?>
	</div>
	<div id="view_blogs">
		<?php include_once("view_blog.php") ?>
	</div>
</div>
	<?php } ?>