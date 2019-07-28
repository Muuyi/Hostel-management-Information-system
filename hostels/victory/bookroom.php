<?php 
	include ("header.php"); 
	include ("admin/functions.php");
?>
<section class="container" style="text-align:center;">
	<div class="row">
	<h1 style="color:A52A2A; font-weight:bolder;">BOOK  ROOM OF YOUR CHOICE</h1>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h3>Single Room</h3><br />
				<img src="images/vic1.jpg" class="RoomImage" /><br /><br />
					<a href="application.php"><button type="button" class="btn btn-primary" >Book now</button></a><br />
				<?php getOne(); ?><br />
				<span class="price">Price:13,000</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h3>Two Sharing</h3><br />
				<img src="images/vic4.jpg" class="RoomImage" /><br /><br />
					<a href="application.php"><button type="button" class="btn btn-primary" >Book now</button></a><br />
				<?php getTwo(); ?><br />
				<span class="price">Price:6,800</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h3>Four Sharing</h3><br />
				<img src="images/vic1.jpg" class="RoomImage" /><br /><br />
					<a href="application.php"><button type="button" class="btn btn-primary" >Book now</button></a><br />
				<?php getFour(); ?><br />
				<span class="price">Price:6,000</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h3>Six Sharing</h3><br />
				<img src="images/vic4.jpg" class="RoomImage" /><br /><br />
				<a href="application.php"><button type="button" class="btn btn-primary" >Book now</button></a><br />
				<?php getSix(); ?><br />
				<span class="price">Price:5,800</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h3>Eight Sharing</h3><br />
				<img src="images/vic1.jpg" class="RoomImage" /><br /><br />
				<a href="application.php"><button type="button" class="btn btn-primary" >Book now</button></a><br />
				<span class="available"><i>Room available</i></span><br />
				<span class="price">Price:5,500</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h3>Ten Sharing</h3><br />
				<img src="images/vic4.jpg" class="RoomImage" /><br /><br />
				<a href="application.php"><button type="button" class="btn btn-primary" >Book now</button></a><br />
				<span class="available"><i>Room available</i></span><br />
				<span class="price">Price:5,000</span>
		</div>
	</div>
</section>
<?php include ("footer.php"); ?>