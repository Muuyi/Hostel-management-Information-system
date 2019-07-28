//Hostels admin side bar menu function
$(document).ready(function(){
	//CHANGE ADMIN PROFILE PICTURE
	//CHANGING THE SINGLE ROOM PICTURE
	$(document).on('change', '#admin_pic', function(){
		var property = document.getElementById("admin_pic").files[0];
		var singleName = property.name;
		var size = property.size;
		var ext = singleName.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'profile_pic_update.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#profileResponse').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img').html(data);
					$('#profileResponse').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//MAKING THE ROOM NUMBER TO BE DEPENDANT WITH ROOM CATEGORY
	$("#croom").on('change', function(){
		var rmcatid = $(this).val();
		$.ajax({
			url:"rm_catdep.php",
			method:"POST",
			data:{rmcatid:rmcatid},
			success:function(data){
				$("#rm_no").html(data);
			}
		});
	});
	//BLOG TABS
	$("#blog_tabs").tabs();
	//PAYMENT TABS WIDGETS
	$("#payment_tabs").tabs();
	//ACCOUNTS TABS WIDGETS
	$("#accounts_tabs").tabs();
	//SUPPLIERS TABS WIDGETS
	$("#suppliers_tabs").tabs();
	//TOGGLING THE MENU BAR IN THE ADMIN SECTION
	$('.has-sub').click(function(){
		$(this).toggleClass('tap');
	});
	//DELETING THE ACCOUNTS TYPES
	$('.acc_delete').click(function(){
		var aid = $(this).attr("id");
		if(confirm("Are you sure you want to delete this clients information?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{aid:aid},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//UPDATING CLIENTS INFORMATION

	//DELETING THE ACCOUNTS details
	$('.acname_dlt').click(function(){
		var acnm = $(this).attr("id");
		if(confirm("Are you sure you want to delete this clients information?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{acnm:acnm},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING THE MESSAGE
	$('.mesDel').click(function(){
		var mesId = $(this).attr("id");
		if(confirm("Are you sure you want to delete this message?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{mesId:mesId},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING A BLOG
	$('.delBlog').click(function(){
		var bId = $(this).attr("id");
		if(confirm("Are you sure you want to delete this blog?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{bId:bId},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING THE ROOM DETAILS
	$('.rm_dlt').click(function(){
		var rmdl = $(this).attr("id");
		if(confirm("Are you sure you want to delete this clients information?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{rmdl:rmdl},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//CHANGING THE SINGLE ROOM PICTURE
	$(document).on('change', '#file', function(){
		var property = document.getElementById("file").files[0];
		var singleName = property.name;
		var size = property.size;
		var ext = singleName.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'room_image_upload.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#snglResponse').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img').html(data);
					$('#snglResponse').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//CHANGING THE TWO SHARING ROOM PICTURE
	$(document).on('change', '#file2', function(){
		var property = document.getElementById("file2").files[0];
		var singleName2 = property.name;
		var size = property.size;
		var ext = singleName2.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images are allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'room_image_upload2.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#snglResponse2').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img2').html(data);
					$('#snglResponse2').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//CHANGING THE FOUR SHARING PICTURE
	$(document).on('change', '#file4', function(){
		var property = document.getElementById("file4").files[0];
		var singleName2 = property.name;
		var size = property.size;
		var ext = singleName2.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images are allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'room_image_upload4.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#snglResponse4').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img4').html(data);
					$('#snglResponse4').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//CHANGING THE SIX SHARING PICTURE
	$(document).on('change', '#file6', function(){
		var property = document.getElementById("file6").files[0];
		var singleName6 = property.name;
		var size = property.size;
		var ext = singleName6.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images are allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'room_image_upload6.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#snglResponse6').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img6').html(data);
					$('#snglResponse6').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//CHANGING THE SIX SHARING PICTURE
	$(document).on('change', '#file8', function(){
		var property = document.getElementById("file8").files[0];
		var singleName8 = property.name;
		var size = property.size;
		var ext = singleName8.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images are allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'room_image_upload8.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#snglResponse8').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img6').html(data);
					$('#snglResponse8').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//CHANGING THE SIX SHARING PICTURE
	$(document).on('change', '#file10', function(){
		var property = document.getElementById("file10").files[0];
		var singleName10 = property.name;
		var size = property.size;
		var ext = singleName10.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
			alert("Invalid image file!Only jpg/jpeg images are allowed!");
		}else if(size > 1000000){
			alert("File size is too large!Only a maximum of 1MB is allowed!");
		}else{
			var formData = new FormData();
			formData.append("file", property);
			$.ajax({
				url:'room_image_upload10.php',
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#snglResponse10').html("<label class='text-danger'>Image uploading.......</label>");
				},
				success:function(data){
					$('#img6').html(data);
					$('#snglResponse10').html("<label class='text-success'>Image successfully uploaded</label>");
				}
			})

		}
	});
	//VIEWING THE CLIENTS DETAILS
	$('.view_data').click(function(){
		var cid = $(this).attr("id");
		$.ajax({
			url:"details.php",
			method:"POST",
			data:{cid:cid},
			success:function(data){
				$("#client_details").html(data);
				$('#cdetails').modal("show");
			}
		});
	});
	//EDITING CLIENTS DATA
	$('.client_edit').click(function(){
		var cid = $(this).attr("id");
		$.ajax({
			url:"edit_client.php",
			method:"POST",
			data:{cid:cid},
			success:function(data){
				$("#cl_edit").html(data);
				$('#cedit').modal("show");
			}
		});
	});
	//CHECKING IN AND OUT OF CLIENTS
	$('.check').click(function(){
		var cid = $(this).attr("id");
		$.ajax({
			url:"check.php",
			method:"POST",
			data:{cid:cid},
			success:function(data){
				$("#cCheck").html(data);
				document.location.reload(true);
			}
		});
	});
	//DELETING CLIENTS INFORMATION FROM THE DATABASE
	$('.delete').click(function(){
		var cid = $(this).attr("id");
		if(confirm("Are you sure you want to delete this clients information?")){
			$.ajax({
			url:"delete_client.php",
			method:"POST",
			data:{cid:cid},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING ROOM IMAGES
	$('.deleteimg').click(function(){
		var cid = $(this).attr("id");
		if(confirm("Are you sure you want to delete this image?")){
			$.ajax({
			url:"img_del.php",
			method:"POST",
			data:{cid:cid},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//MOBILE MENU BAR
	$(".fa-times").click(function(){
		$("#adminMenu").css("left","-90%");
	});
	$(".menu").click(function(){
		$("#adminMenu").css("left","0px");
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
	//ENSURING THE ID NUMBER EXISTS BEFORE POSTING PAYMENT
	$("#id").keyup(function(){
		var idNo = $(this).val();
		if(idNo != ''){
			$.ajax({
				url:"pay_id.php",
				method:"POST",
				data:{idNo:idNo},
				success:function(data){
					$('#payment').fadeIn();
					$('#payment').html(data);
				}
			});
		}
	});
//Ensuring the thumbnails heights of images in the admin section are equal
	$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".image");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
//Ensuring the heights of admin sections are equal
	$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".admin");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
//Ensuring the section of the image sections are equal
	$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".gallery");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
//Ensuring the images in the gallery sections are of equal heights
$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".img-thumbnail");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
//ENSURING ALL THE SECTIONS OF BLOG PAGE ARE OF EQUAL SIZE
$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".aside");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
//LOADING DATA TO THE ADMIN SECTION USING BUTTONS TO SHOW ADMIN DETAILS
	
	$('#adminArea').load('edit_account.php');
	$('#adminHeader ul li a').click(function(){
		var page = $(this).attr('href');
		$('adminArea').load('../admin/'+ page + '.php');
	});
	
});
function pay(){
	alert("This function is currently unavailable. It will be activated after full payment of the site!");
}