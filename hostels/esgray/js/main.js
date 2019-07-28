//Hostels admin side bar menu function
$(document).ready(function(){
	//EDITING CLIENTS INFORMATIONS
	$(document).on('click', '#cl_submit', function(){
		
	})
	//EDITING SYSTEM USERS DETAILS
	$(document).on('click', '.edit_sysuser', function(){
		$('#addusers').modal('toggle');
		var sys_id = $(this).attr("id");
		$.ajax({
			url:"ajax.php",
			method:"POST",
			data:{sys_id:sys_id},
			dataType:"JSON",
			success:function(data){
				//$('#sys_id').val(data.admin_id);
				$('#fname').val(data.admin_FName);
				$('#lname').val(data.admin_LName);
				$('#email').val(data.admin_Email);
				$('#idno').val(data.admin_IDNo);
				$('#phone').val(data.phone);
				$('#username').val(data.admin_Username);
				$('#password').val(data.admin_pass);
				//$('#user').val(data.admin_usertype);
				$('#insert').val("Update");
				$('#addusers').modal('toggle');
			}
		})
	})
	//ENSURING THAT BOTH PASSWORDS FIELDS MATCH
	$("#pass2").keyup(function(){
		var pass1 = $('#pass1');
		var pass2 = $('#pass2');
		if(pass1 != pass2){
			$('#pass2').addClass('warning_bd');
			$('#passerror').html("<i><label class='text-danger'>Please ensure that both fields match!</label></i>");
		}else{
			$('#pass2').removeClass('warning_bd');
			$('#passerror').empty();
		}
	});
	//CONFIRMING IF THE EMAIL OF THE CLIENT EXISTS BEFOR CHANGING THE PASSWORD
	$("#passEmail").keyup(function(){
		var email = $(this).val();
		if(email != ''){
			$.ajax({
				url:"forgotpassword2.php",
				method:"POST",
				data:{email:email},
				beforeSend:function(){
					$('#emaiSubmit').html("<i><label class='text-danger'>Please wait while the system confirms your email address....</label></i>");
				},
				success:function(data){
					$('#emailSubmit').html(data);
				}
			});
		}
	});
	//CHANGING THE SINGLE ROOM PICTURE
	/*$(document).on('change', '.admin_pic', function(){
		var p = $(this).attr("id").files[0];
		var singleName = p.name;
		var size = p.size;
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
	});*/
	//ENSURING THE CORRECT EMPLOYEE IS SELECTED AND SHOWING HIS SALARY IN THE SALARY SECTION
	$("#account_title").on('change', function(){
		var acc_id = $(this).val();
		$.ajax({
			url:"rm_catdep.php",
			method:"POST",
			data:{acc_id:acc_id},
			success:function(data){
				//alert(data);
				$("#account_type").html(data);
			}
		});
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
	//VACANCIES SECTION TABS
	$("#vacancy_tabs").tabs();
	//EMPLOYEE SECTION TABS
	$("#employees_tab").tabs();
	//REPORTS TABS
	$("#reports_tab").tabs();
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
	//DELETING THE VACANCE FROM THE DATABASE
	$('.vacance_delete').click(function(){
		var vac_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this vacance?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{vac_id:vac_id},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
			});
		}
		});
	
	//DELETING AN INVOICE
	$('.inv_delete').click(function(){
		var inv_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this invoice?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{inv_id:inv_id},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING SUPPLIERS
	$('.s_delete').click(function(){
		var sid = $(this).attr("id");
		if(confirm("Are you sure you want to delete this supplier?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{sid:sid},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING THE EMPLOYEES
	$('.emp_del').click(function(){
		var emp = $(this).attr("id");
		if(confirm("Are you sure you want to delete this employee?")){
			$.ajax({
			url:"accounts_delete.php",
			method:"POST",
			data:{emp:emp},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
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
	//ACTIVATING AND DEACTIVATING ADMINISTRATORS
	$('.admin_state').click(function(){
		var adId = $(this).attr("id");
		if(confirm('Are you sure you want to change the status of the admin!')){
			$.ajax({
			url:"check.php",
			method:"POST",
			data:{adId:adId},
			success:function(data){
				$("#adminStatus").html(data);
				document.location.reload(true);
			}
		});
		}
	});
	//CHECKING IN AND OUT OF CLIENTS
	$('.check').click(function(){
		var cid = $(this).attr("id");
		if(confirm('Are you sure you want to change the clients status')){
			$.ajax({
			url:"check.php",
			method:"POST",
			data:{cid:cid},
			success:function(data){
				$("#cCheck").html(data);
				document.location.reload(true);
			}
		});
		}
	});
	//DELETING PAYMENT DETAILS
	$('.pdelete').click(function(){
		var payment_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this payment?")){
			$.ajax({
			url:"delete_client.php",
			method:"POST",
			data:{payment_id:payment_id},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING TRANSACTIONS
	$('.trans_del').click(function(){
		var trans_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this transaction?")){
			$.ajax({
			url:"delete_client.php",
			method:"POST",
			data:{trans_id:trans_id},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
	});
	//DELETING EMPLOYEES SALARY DETAILS
	$('.sal_delete').click(function(){
		var sal_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this employees salary details?")){
			$.ajax({
			url:"delete_client.php",
			method:"POST",
			data:{sal_id:sal_id},
			success:function(data){
				alert(data);
				document.location.reload(true);
			}
		});
		}
		
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
	//DELETING ADMINS INFORMATION FROM THE DATABASE
	$('.admin_delete').click(function(){
		var adDel = $(this).attr("id");
		if(confirm("Are you sure you want to delete this user?")){
			$.ajax({
				url:"delete_admin.php",
				method:"POST",
				data:{adDel:adDel},
				success:function(data){
					alert(data);
					document.location.reload(true);
				}
			});
		}
	})
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
//ENSURING THE HOME DIV TAGS
$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".home");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
	});
//ENSURING THE THUMBNAILS OF THE HOSTELS IN THE HOME PAGE ARE EQUAL HEIGHT
	$(function(){
		var tallest = 0;
		$columnsToEqualize = $(".other-hostel");
		$columnsToEqualize.each(function(){
			var thisHeight = $(this).height();
			if(thisHeight > tallest){
				tallest = thisHeight;
			}
		});
		$columnsToEqualize.height(tallest);
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