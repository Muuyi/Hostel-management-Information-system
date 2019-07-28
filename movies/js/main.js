$(document).ready(function(){
	//IMAGE SLIDESHOW SECTION
	$('#slide1').cycle({
		fx:'zoom',
		speed:'1000'
	});
	$('#slide4').cycle({
		fx:'fade',
		speed:'1000'
	});
	$('#slide2').cycle({
		fx:'turnDown',
		speed:'1000'
	});
	$('#slide5').cycle({
		fx:'curtainX',
		speed:'1000'
	});
	$('#slide3').cycle({
		fx:'scrollRight',
		speed:'1000'
	});
	$('#slide6').cycle({
		fx:'shuffle',
		speed:'1000'
	});
	//SEARCHING THE DATABASE FOR MOVIES
	$("#search").keyup(function(){
		var query = $(this).val();
		if(query != ''){
			$.ajax({
				url:"search.php",
				method:"POST",
				data:{query:query},
				success:function(data){
					$('#results').fadeIn();
					$('#results').html(data);
				}
			});
		}
	});
	$("#movName").keyup(function(){
		var name = $(this).val();
		if(name != ''){
			$.ajax({
				url:"search.php",
				method:"POST",
				data:{name:name},
				success:function(data){
					$('#movAvail').fadeIn();
					$('#movAvail').html(data);
				}
			});
		}
	});
	$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".mov");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
});