<?php
	//INCLUDING THE HEADER PAGE
	include ("header.php");
?>

<?php 
	//FINDING IF THERE IS ANY INFORMATION IN THE DATABASE
	include_once("db.php");
	$getGallery = "SELECT * FROM gallery WHERE host_id='".$_COOKIE['esgray_westlands']."' ORDER BY g_id DESC";
	$runGallery = mysqli_query($con, $getGallery);
	$count = mysqli_num_rows($runGallery);
	if($count === 0){
		echo "<script>alert('Currently there are no images available!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}else{
?>
<section class="row">
	<!--DIV TAGS TO FAKE THE SIDEBAR TAG-->
			<div class="admin-sidebar">
				<div class="admin-sidebar-inner">
				</div>
			</div>
			<!--END -->
	<article class="col-lg-2 col-md-2 hidden sidebar">
		<div class="sidebar-inner">
			JJJJJJJJJJJJJJJJJJJJJJJJJJJ
		</div>
	</article>
	<article class="col-lg-8">
		<div class="row flex-box">
			<?php
				while($row = mysqli_fetch_array($runGallery)){
					$image = $row['g_name'];
			?>
				<div class="col-md-3 col-sm-6" style="padding:5px; box-sizing:border-box;">
					<a href='../../admins/images/<?php echo "$image" ?>' data-lightbox="gallery"><img src='../../admins/images/<?php echo "$image" ?>' class="img-fluid gallery-image" width="100%" /></a>
				</div>
			
			<?php }	?>
		</div>
	</article>
	<article class="col-lg-2 col-md-2 hidden sidebar2">
		<div class="sidebar-inner2">
			JJJJJJJJJJJJJJJJJJJJJJJJJJJ
		</div>
	</article>
</section>
<?php } ?>
<?php
	include_once("footer.php");
?>