<?php 
	include ("header.php"); 
	include ("admin/functions.php");
?>
<section class="container" style="text-align:center;">
	<div class="row">
	<h5 style="color:#A52A2A; font-weight:bolder;">BOOK  ROOM OF YOUR CHOICE</h5>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h4>Double Occupancy</h4>
				<?php
					$sql = "SELECT * FROM category where cat_id ='2'";
					$rSql = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($rSql);
					$img = $row['room_photo'];
					if($row['room_photo'] == ''){
						echo '<img src="images/room.jpg" width="100%" class="img-responsive" style="border:1px solid #808080;">';
					}else{
						echo "<img src='admin/images/$img' width='100%' class='img-responsive' style='border:1px solid #808080;'>";
					}
				?>
				<?php getTwo(); ?><br />
				<span class="price">Price: Kshs. 9,500</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h4>Four Sharing</h4>
				<?php
					$sql = "SELECT * FROM category where cat_id ='4'";
					$rSql = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($rSql);
					$img = $row['room_photo'];
					if($row['room_photo'] == ''){
						echo '<img src="images/room.jpg" width="100%" class="img-responsive" style="border:1px solid #808080;">';
					}else{
						echo "<img src='admin/images/$img' width='100%' class='img-responsive' style='border:1px solid #808080;'>";
					}
				?>
				<?php getFour(); ?><br />
				<span class="price">Price: Kshs. 8,000</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h4>Six Sharing</h4>
				<?php
					$sql = "SELECT * FROM category where cat_id ='6'";
					$rSql = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($rSql);
					$img = $row['room_photo'];
					if($row['room_photo'] == ''){
						echo '<img src="images/room.jpg" width="100%" class="img-responsive" style="border:1px solid #808080;">';
					}else{
						echo "<img src='admin/images/$img' width='100%' class='img-responsive' style='border:1px solid #808080;'>";
					}
				?>
				<?php getSix(); ?><br />
				<span class="price">Price: Kshs. 7,500</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h4>Eight Sharing</h4>
				<?php
					$sql = "SELECT * FROM category where cat_id ='8'";
					$rSql = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($rSql);
					$img = $row['room_photo'];
					if($row['room_photo'] == ''){
						echo '<img src="images/room.jpg" width="100%" class="img-responsive" style="border:1px solid #808080;">';
					}else{
						echo "<img src='admin/images/$img' width='100%' class='img-responsive' style='border:1px solid #808080;'>";
					}
				?>
				<?php getEight(); ?><br />
				<span class="price">Price: Kshs. 7,000</span>
		</div>
	</div>
</section>
<?php include ("application.php"); ?>
<?php include ("footer.php"); ?>