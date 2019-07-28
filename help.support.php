<?php
	include_once("header.php");
?>
	<div class="container-fluid">
		<?php
			$q = "SELECT * FROM help_support";
			$rQ = mysqli_query($con, $q);
		?>
		<div class="row">
			<div class="col-lg-1 hidden-md sidebar">
				<div class="sidebar-inner">
					xxxxxxx
				</div>
			</div>
			<div class="col-lg-2 col-md-2 hidden sidebar2">
					<div class="sidebar-inner2">
						<?php
							while($row = mysqli_fetch_array($rQ)){
								echo'
									<ul>
										<li><a href="#'.$row['id_attr'].'">'.$row['title_summary'].'</a></li>
									</ul>
								';
							}
						?>
					</div>
			</div>
			<div class="col-lg-7 col-md-8">
				<input type="text" id="search_blog" placeholder="Search blog......" class="form-control" />
				<div id="blog_section" style="width:100%">
					
				</div>
				<!--LOADING ICON BEFORE DATA IS SUBMITTED-->
				<div id="load_blog" style="text-align:center;"></div>
			</div>
			<div class="col-lg-2 col-md-2 hidden sidebar3">
				<div class="sidebar3-inner">
					<div id="window"></div>
					<div id="window-h"></div>
					<div id="document"></div>
					gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
				</div>
			</div>
		</div>
	</div>
<?php
	include_once("footer.php");
?>
<script>
	//CREATING A STICKY SIDEBAR
		simpleStickySidebar('.sidebar3-inner', {
	  		container: '.sidebar3',
	  		topSpace: 150,
	  		bottomSpace : 150
		});
</script>