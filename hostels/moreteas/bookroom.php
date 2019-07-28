<?php 
	include ("header.php"); 
	include ("admin/functions.php");
?>
<section class="container" style="text-align:center;">
	<div class="row">
	<h4 style="color:A52A2A; font-weight:bolder;">BOOK  ROOM OF YOUR CHOICE</h4>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h5> Room 1</h5>
				<?php
					$sql = "SELECT * FROM category where cat_id ='1'";
					$rSql = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($rSql);
					$img = $row['room_photo'];
					if($row['room_photo'] == ''){
						echo '<img src="images/room.jpg" width="100%" class="img-responsive" style="border:1px solid #808080;">';
					}else{
						echo "<img src='admin/images/$img' width='100%' class='img-responsive' style='border:1px solid #808080;'>";
					}
				?>
				<?php getOne(); ?><br />
				<span class="price">Price:10,000</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h5>Room 2</h5>
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
				<span class="price">Price:9,500</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h5>Room 3</h5><br />
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
				<span class="price">Price:8,500</span>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h5>Room 4</h5>
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
				<span class="price">Price:7,500</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
				<h5>Room 5</h5>
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
				<span class="price">Price:7,000</span>
		</div>
	</div>
</section>
<?php include ("application.php"); ?>
<?php include ("footer.php"); ?>