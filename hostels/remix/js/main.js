//Hostels admin side bar menu function
$(document).ready(function(){
	$(".fa-times").click(function(){
		$(".sidebar_menu").addClass("hide_menu");
		$(".toggle-menu").addClass("opacity_one");
	});
	$(".toggle-menu").click(function(){
		$(".sidebar_menu").removeClass("hide_menu");
		$(".toggle-menu").removeClass("opacity_one");
	});
	//UPDATING THE CLIENTS STATUS
	//When the user clicks on check in
	$(".check").click(function(){
		var cId = $(this).attr('id');
		$.ajax({
			url:'admin.php?view_clients',
			type:'post',
			async:'false',
			data:{
				'check':1,
				'cId':cId
			},
			success:function(){
				
			}
		});
	});
	//When the user clicks on check out function
		$(".uncheck").click(function(){
		var cId = $(this).attr('id');
		$.ajax({
			url:'search.php',
			type:'post',
			async:'false',
			data:{
				'uncheck':1,
				'cId':cId
			},
			success:function(){
				
			}
		});
	});
	//SEARCHING THE DATABASE FOR CLIENTS
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
});
function checkout(id){
	var clId = id;
	var clint = document.getElementById(clId);
	$.ajax({
		url:"check.php",
		method:"POST",
		data:{clId:clId},
		success:function(data){
			clint.innerHTML(data);
		}
	})
}
	//CLIENT FORM VALIDATION FUNCTION
	/*$("#submit").click(function(e){
		e.preventDefault();
	});
});
//UPLOADING IMAGES FUNCTION
/function #(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = #("image").files[0];
	var formdata = new formData();
	formdata.append("image", file);
	var ajax = new XMLHttpRequest()
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "post_images.php");
	ajax.send(formdata);
}
function progressHandler(event){
	var percent = (event.loaded / event.total)*100;
	#("progressBar").value = Math.round(percent);
}
function completeHandler(event){
	#("status").innerHTML = event.target.responseText;
	#("progressBar").value = Math.round(percent);
}
function errorHandler(event){
	#("status").innerHTML = "Upload failed";
}
function abortHandler(event){
	#("status").innerHTML = "Upload aborted";
}*/
function pay(){
	alert("This function is currently unavailable. It will be activated after full payment of the site!");
}