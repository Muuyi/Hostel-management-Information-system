<?php
	//INCLUDING THE HEADER PAGE
	include ("header.php");
?>

<?php 
	//FINDING IF THERE IS ANY INFORMATION IN THE DATABASE
	include_once("db.php");
	$getGallery = "SELECT * FROM gallery ORDER BY g_id DESC";
	$runGallery = mysqli_query($con, $getGallery);
	$count = mysqli_num_rows($runGallery);
	if($count === 0){
		echo "<script>alert('Currently there are no images available!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}else{
?>
<section class="row">
	<article class="col-lg-2 col-md-2 hidden-sm hidden-xs gallery" style="background-color:#D3D3D3;">
		<center>Ads</center>
	</article>
	<article class="col-lg-8 col-md-8 col-md-12 gallery">
		<div class="row">
		<?php
			while($row = mysqli_fetch_array($runGallery)){
				$image = $row['g_name'];
				$caption = $row['caption'];
		?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-sm-6 col-xs-6">
				<a href='admin/gallery/<?php echo "$image" ?>' data-title='<?php echo "$caption" ?>' data-lightbox="gallery"><img src='admin/gallery/<?php echo "$image" ?>' width="100%" class="img-thumbnail"/></a>
				<p style="text-align:center;"><?php echo "$caption" ?></p>
			</div>
		
		<?php }	?>
		</div>
	</article>
	<article class="col-lg-2 col-md-2 hidden-sm hidden-xs gallery" style="background-color:#D3D3D3;">
		<center>Ads</center>
	</article>
</section>
<?php } ?>
<?php
	include_once("footer.php");
?>