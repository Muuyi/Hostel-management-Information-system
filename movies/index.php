<?php 
	require_once("header.php");
?>
<section class="row">
	<article class="col-lg-2 col-md-2 hidden-sm hidden-xs mov" style='background-color:#D3D3D3;'>
		<div id="slide1">
			<img src="images/quantico.jpg" width="100%" class="img-responsive" />
			<img src="images/originals.jpg" width="100%" class="img-responsive" />
			<img src="images/power.jpg" width="100%" class="img-responsive" />
			<img src="images/badlands.jpg" width="100%" class="img-responsive" />
			<img src="images/dusk.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
		</div>
		<div id="slide2">
			<img src="images/fast.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/dusk.jpg" width="100%" class="img-responsive" />
			<img src="images/quantico.jpg" width="100%" class="img-responsive" />
			<img src="images/originals.jpg" width="100%" class="img-responsive" />
			<img src="images/vikings.jpg" width="100%" class="img-responsive" />
			
			<img src="images/power.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/badlands.jpg" width="100%" class="img-responsive" />
		</div>
		<div id="slide3">
			<img src="images/badlands.jpg" width="100%" class="img-responsive" />
			<img src="images/wonderwoman.jpg" width="100%" class="img-responsive" />
			<img src="images/dusk.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/quantico.jpg" width="100%" class="img-responsive" />
			<img src="images/originals.jpg" width="100%" class="img-responsive" />
			<img src="images/power.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
		</div>
	</article>
	<article class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mov" id="mainPage">
		<h1><center>ALL MOVIES AVAILABLE</center></h1>
		<div class="form-group">
			<input type="text" class="form-control" name="search" id="search" placeholder="Search for a movie by name......" />
			<div id="results"></div>
		</div>
		<?php 
			getMovies(); 
			getMov();
			getMovCat();
		?>
	</article>
	<article class="col-lg-2 col-md-2 hidden-sm hidden-xs mov" style='background-color:#D3D3D3;'>
		<div id="slide4">
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/quantico.jpg" width="100%" class="img-responsive" />
			<img src="images/originals.jpg" width="100%" class="img-responsive" />
			<img src="images/power.jpg" width="100%" class="img-responsive" />
			<img src="images/vampire.jpg" width="100%" class="img-responsive" />
			<img src="images/badlands.jpg" width="100%" class="img-responsive" />
			<img src="images/dusk.jpg" width="100%" class="img-responsive" />
		</div>
		<div id="slide5">
			<img src="images/badlands.jpg" width="100%" class="img-responsive" />
			<img src="images/dusk.jpg" width="100%" class="img-responsive" />
			<img src="images/quantico.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/fast.jpg" width="100%" class="img-responsive" />
			<img src="images/originals.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/power.jpg" width="100%" class="img-responsive" />
		</div>
		<div id="slide6">

			<img src="images/power.jpg" width="100%" class="img-responsive" />
			<img src="images/badlands.jpg" width="100%" class="img-responsive" />
			<img src="images/dusk.jpg" width="100%" class="img-responsive" />
			<img src="images/ghosts.jpg" width="100%" class="img-responsive" />
			<img src="images/empire.jpg" width="100%" class="img-responsive" />
			<img src="images/quantico.jpg" width="100%" class="img-responsive" />
			<img src="images/originals.jpg" width="100%" class="img-responsive" />
			
		</div>
	</article>
</section>
<?php require_once("footer.php"); ?>