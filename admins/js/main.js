//Hostels admin side bar menu function
$(document).ready(function(){
	var hostel_id = $("#hostel_id").val();
	//ADDING SEARCH BOX TO SELECT INPUT TAG
		$('select').select2({
			theme:'bootstrap'
		});
	//CREATING A STICKY SIDEBAR
		simpleStickySidebar('.sidebar-inner', {
	  		container: '.sidebar',
	  		topSpace: 100,
	  		bottomSpace : 100
		});
		simpleStickySidebar('.sidebar-inner2', {
	  		container: '.sidebar2',
	  		topSpace: 100,
	  		bottomSpace : 100
		});
//////////////////////////////////////////////////ADMIN SIDE BAR MENU SECTION//////////////////////
	//FIXED POSITIONING ADMIN SIDE BAR
		var sidebar_width = $("#adminMenu").width();
		var screen_width = $(window).width();
		if(screen_width > 768){
			$("#adminContent").css('margin-left',sidebar_width+20);
		}
	//MOBILE MENU BAR
		$(".fa-times").click(function(){
			$("#adminMenu").css("left","-90%");
		});
		$(document).on('click','#menu',function(){
			$(this).toggleClass('.on');
			$("#adminMenu").css("left","0px");
		});
//////////////////////////////////////////////////LOG IN SECTION //////////////////////////////////
	//FORGOT PASSWORD SECTION
		$("#forgot_password_page").click(function(e){
			e.preventDefault();
			$("#log_in_body").html('<div class="form-group"><h3>Change password</h3><label class="labels" for="Email">Enter your email</label><input type="email" id="password_email" placeholder="Enter your email" class="form-control" /><div id="password_response"></div><button type="button" id="change_pass_mail" class="btn btn-success form-control">Send change password mail</button><br /><a href="login.php"><i>Back to login page</i></a></div>');
		})
	//SEND MAIL
		$(document).on('click','#change_pass_mail',function(){
			var email = $("#password_email").val();
			var confirm_pass_email = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{email:email,confirm_pass_email:confirm_pass_email},
				success:function(data){
					if(data == 'available'){
						$("#log_in_body").html('<div class="alert alert-success">A change password email has been sent to your email address. Please visit your email to change the password</div>')
					}else{
						$("#password_response").html("<span style='color:#FF0000;'>The email address does not exist. Please ensure you have entered the email correctly!</span>");
						$("#password_email").css("border","1px solid #FF0000");
					}
				}
			})
		})
///////////////////////////////////////////////////HOSTELS CONTACT US SECTION////////////////////////
	///////MOBILE PHONE INTL VALIDATION////////////////////
	$("#cphone").intlTelInput();
/////////////////////////////////////////////////MESSAGES SECTION///////////////////////////////////////
	//DELETING THE MESSAGE
		$('.mesDel').click(function(){
			var mesId = $(this).attr("id");
			if(confirm("Are you sure you want to delete this message?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{mesId:mesId},
				success:function(data){
					alert(data);
					document.location.reload(true);
				}
			});
			}
		});
////////////////////////////////////////////////////////INDIVIDUAL HOSTEL SCRIPTS SECTION//////////////
	//////IMAGE SLIDESHOW
		$('.slideshow').cycle({
			fx:'zoom',
			speed:'1000'
		});
	////POSTING HOSTELS MESSAGE
		$("#send_hostel_message").click(function(e){
			e.preventDefault();
			var name = $("#names").val();
			var phone = $("#cphone").val();
			var subject = $("#mes_subject").val();
			var mes = CKEDITOR.instances['mes'].getData();
			var hostel = $("#host_mes_id").val();
			var submit_hostel_message = '';
			if(mes.length == 0){
				$("#mesresponse").html("<span style='color:red;'>This field cannot be empty</span>");
			}else{
				$("#mesresponse").html('');
				if(!ValidateFullNames('names','namesresponse') || !ValidateTel('cphone','phoneresponse')){
					$("#contact_us_form").html("<div class='alert alert-danger'>Please ensure both fields are valid before submission of data!</div>");
				}else{
					$.ajax({
						url:'../../admins/ajax.php',
						method:'POST',
						data:{name:name,phone:phone,mes:mes,hostel:hostel,submit_hostel_message:submit_hostel_message,subject:subject},
						success:function(data){
							alert('You have successfully send a message');
							$("#contact_us_form").html(data).fadeOut(20000);
							$("#hostel_message")[0].reset();
						}
					})
				}
			}
		});
////////////////////////////////////////////////////HOSTEL CONTENT SECTION//////////////////////////////
	//CONTACTS PHONE NUMBER
		$("#contact1").intlTelInput();
		$("#contact2").intlTelInput();
	//DELETING A REQUIREMENT
		$(".delete_requirement").click(function(){
			var req_id = $(this).attr("id");
			var delete_hostel_requirement = '';
			if(confirm('Are you sure you want to delete this requirement!')){
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{delete_hostel_requirement:delete_hostel_requirement,req_id:req_id},
					success:function(data){
						alert(data);
						document.location.reload(true);
						$("#hostel_tabs").tabs({active:3});
					}
				})
			}
		})
	//DELETING HOSTEL SERVICE
		$(".delete_service").click(function(){
			var hs_id = $(this).attr("id");
			var delete_hostel_service = '';
			if(confirm('Are you sure you want to delete this service!')){
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{delete_hostel_service:delete_hostel_service,hs_id:hs_id},
					success:function(data){
						alert(data);
						document.location.reload(true);
						$("#hostel_tabs").tabs({active:2});
					}
				})
			}
		})
	//DELETING HOSTEL ROOM PRICES 
		$(".delete_room_price").click(function(){
			var rm_id = $(this).attr("id");
			var delete_rm_prc = '';
			if(confirm('Are you sure you want to delete this room category?')){
				$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{rm_id:rm_id,delete_rm_prc:delete_rm_prc},
				success:function(data){
					alert(data);
					document.location.reload(true);
					$("#hostel_tabs").tabs({active:1});
				}
				})
			}
		})
	//EDITING HOSTELS IMAGE PROFILE PICTURE
		$("#hostelProfilePic").change(function(){
			var current_image_name = $(this).data("image");
			var hostel_profile_pic = document.getElementById("hostelProfilePic").files[0];
			var change_hostel_profile = '';
			var name = hostel_profile_pic.name;
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['jpg','jpeg','png'])== -1){
				$("#hostelPicResponse").html("<label class='text-danger'>"+name+" contains an invalid image format. Only jpg/jpeg/png is allowed</label>");
			}else{
				var formData = new FormData();
				formData.append("hostel_profile_pic", hostel_profile_pic);
				formData.append("change_hostel_profile", change_hostel_profile);
				formData.append("hostel_id", hostel_id);
				formData.append("current_image_name", current_image_name);
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:formData,
					contentType:false,
					cache:false,
					processData:false,
					beforeSend:function(){
						$("#hostelPicResponse").html("<label class='text-danger'>Image uploading.......</label>");
					},
					success:function(data){
						$(".hostelProfileImg").attr('src', data);
						$("#hostelPicResponse").text('');
						$("#hostelProfilePic").val('');
					},
				});
			}
		})
	//SUBMITING A HOSTEL SERVICE TO THE DATABASE
		$("#submit_service").click(function(e){
			e.preventDefault();
			var service = $("#service_name").val();
			var submit_hostel_service = '';
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{service:service,submit_hostel_service:submit_hostel_service,hostel_id:hostel_id},
				success:function(data){
					alert(data);
					$("#service_name").val('');
				}
			})
		})
	//HOSTEL TABS
		$("#hostel_tabs").tabs();
	//FILLING THE ROOM EDIT FORM WITH DATA HOSTEL ROOM PRICES
		$(".edit_room_price").click(function(){
			var room_price_id = $(this).attr("id");
			var view_room_price_details = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{room_price_id:room_price_id,view_room_price_details:view_room_price_details},
				dataType:"json",
				success:function(data){
					$("#room_category").val(data.cat_name);
					$("#room_price").val(data.room_amount);
					$("#rm_id").val(data.rm_photo_id);
					$("#update_room_modal").modal('show');
				},
			});
		}); 
	//EDITING ROOM EDIT FORM AND SUBMITTING THE VALUES TO THE DATABASE
		$("#update_room_price").click(function(){
			var room_price = $("#room_price").val();
			var rm_id = $("#rm_id").val();
			var update_room_price = '';
			if(!ValidateNumerals('room_price',0,100000,'roompriceresponse')){
				$("#room_price_response").html('<div class="alert alert-danger">Please ensure all the form fields are valid before submission</div>').fadeOut(20000);
			}else{
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{room_price:room_price,rm_id:rm_id,update_room_price:update_room_price},
					success:function(data){
						$("#room_price_response").html(data).fadeOut(10000);
						$("#update_room_modal").modal('hide').fadeOut(10000);
						document.location.reload(true);
						$("#hostel_tabs").tabs({active:1});
					}
				});
			}
		})	
	//SAVING A NEW SERVICE TO THE DATABASE
		$("#save_service").click(function(e){
			e.preventDefault();
			var service = $("#new_service").val();
			var save_service = '';
			if(!ValidateVariousCharacters('new_service',5,255,'new_service_response')){
				$("#serviceResponse").html('<div class="alert alert-danger">Please ensure all field are valid before submission</div>').fadeOut(10000);
			}else{
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{service:service,save_service:save_service},
					success:function(data){
						$("#serviceResponse").html(data).fadeOut(5000);
						$("#new_service").val('');
					}
				});
			}
		});
////////////////////////////////////////////////////////////////////////STUDENTS SECTION////////////////////////////////////////////////////
	//CHANGE STUDENTS PROFILE PICTURE
		$("#change_client_profile").on("change", function(){
			var property = document.getElementById("change_client_profile").files[0];
			var client_id = $("#client_id").val();
			var change_student_image='';
			var name = property.name;
			var size = property.size;
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['jpg','jpeg','png']) == -1){
				alert("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#studentProfileResponse").text("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#change_client_profile").val("");
			}else if(size > 1000000){
				alert("File is too large!Only a maximum of 1MB is required!");
				$("#studentProfileResponse").text("File is too large!Only a maximum of 1MB is required!");
				$("#change_client_profile").val("");
			}else{
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{property:property,client_id:client_id,change_student_image:change_student_image},
					contentType:false,
					cache:false,
					processData:false,
					beforeSend: function(){
						$("#studentProfileResponse").html("<label class='text-danger'>Image uploading.....................</label>");
					},
					success: function(data){
						alert(data);
						$(".studentProfileImg").attr('src', data);
						$("#studentProfileResponse").html("<label class='text-success'>Image uploaded successfully</label>");
						$("#studentProfile").val("");
					}
				});
			}
		});
///////////////////////////////////////////////////////////////////////IMAGES SECTION////////////////////////////////////////////////////////
	//DELETING HOSTELS IMAGES
		$(".delete_hostel_images").click(function(){
			var imageId = $(this).attr("id");
			var delete_hostel_image = '';
			if(confirm("Are you sure you want to delete this image?")){
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{imageId:imageId,delete_hostel_image:delete_hostel_image},
					success:function(data){
						alert(data);
						document.location.reload(true);
					},
				});
			}
		});
	//UPLOADING HOSTELS IMAGES
		$(".drag_area").on('dragover', function(){
			$(this).addClass('drag_over');
			return false;
		});
		$(".drag_area").on('dragleave', function(){
			$(this).removeClass('drag_over');
		});
	//UPLOADING GALLERY IMAGES BY CLICKING THE FILE BUTTON
			$("#upload_gallery_images").on('change', function(){
				var image_errors = '';
				var upload_images = '';
				var formData = new FormData();
				var file_list = $("#upload_gallery_images")[0].files;
				for(i=0;i<file_list.length;i++){
					var name = file_list[i].name;
					var size = file_list[i].size;
					var ext = name.split('.').pop().toLowerCase();
					if(jQuery.inArray(ext, ['gif','jpg','jpeg','png']) == -1){
						image_errors += '<label class="text-danger">'+name+' contains an invalid file extension. Only jpeg/jpg/gif/png images are allowed</label> <br />';
					}else if(size > 1000000){
						image_errors += '<label class="text-danger">'+name+' size is too large. Only a maximum of 1MB is allowed!</label> <br />';
					}else{
						formData.append('file[]', file_list[i]);
					}
				}
				formData.append('upload_images',upload_images);
				formData.append('hostel_id',hostel_id);
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:formData,
					contentType:false,
					cache:false,
					processData:false,
					dataType:"json",
					beforeSend:function(){
						$('#image_error_response').html("<label class='text-danger'>Images uploading.......</label>");
					},
					success:function(data){
						$('#image_error_response').html(image_errors+'<br />'+data.error);
						$('#uploaded_images_response').html(data.photos);
					},
				});
			})
	//UPLOADING GALLERY IMAGES BY DRAGGING AND DROPING IN THE UPLOAD SECTION
			$(".drag_area").on('drop', function(e){
				var image_errors = '';
				var upload_images = '';
				e.preventDefault();
				$(this).removeClass('drag_over');
				var formData = new FormData();
				var file_list = e.originalEvent.dataTransfer.files;
				for(i=0;i<file_list.length;i++){
					var name = file_list[i].name;
					var size = file_list[i].size;
					var ext = name.split('.').pop().toLowerCase();
					if(jQuery.inArray(ext, ['gif','jpg','jpeg','png']) == -1){
						image_errors += '<label class="text-danger">'+name+' contains an invalid file extension. Only jpeg/jpg/gif/png images are allowed</label> <br />';
					}else if(size > 1000000){
						image_errors += '<label class="text-danger">'+name+' size is too large. Only a maximum of 1MB is allowed!</label> <br />';
					}else{
						formData.append('file[]', file_list[i]);
					}
				}
				formData.append('upload_images',upload_images);
				formData.append('hostel_id',hostel_id);
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:formData,
					contentType:false,
					cache:false,
					processData:false,
					dataType:"json",
					beforeSend:function(){
						$('#image_error_response').html("<label class='text-danger'>Images uploading.......</label>");
					},
					success:function(data){
						$('#image_error_response').html(image_errors+'<br />'+data.error);
						$('#uploaded_images_response').html(data.photos);
					},
				});
			});
///////////////////////////////////////////////////////////////////////ROOMS SECTION/////////////////////////////////////////////////////////
	//GETTING SLIDE SHOW IMAGES AND DISPLAYING IT ON A TABLE IN THE ADMIN SECTION
		GetSlideShowImages();
		function GetSlideShowImages(){
			var get_slide_show_images_table = '';
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{get_slide_show_images_table:get_slide_show_images_table,hostel_id:hostel_id},
				success:function(data){
					$("#slideshow_table_body").html(data);
				}
			})
		}
	//DELETING SLIDESHOW IMAGES
		$(document).on('click','.delete_slideshow',function(){
			var slide_id = $(this).attr("id");
			var delete_slide = '';
			if(confirm('Are you sure you want to delete this image!')){
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{slide_id:slide_id,delete_slide:delete_slide},
					success:function(data){
						alert(data);
						GetSlideShowImages();
					}
				});
			}
		})
	//SAVING SLIDE IMAGE TO THE DATABASE
		$("#upload_slide_image").click(function(){
			var image = document.getElementById("slide_image").files[0];
			var name = image.name;
			var header = $("#slide_header").val();
			var content = $("#slide_content").val();
			alert(content);
			var submit_value = $("#submit_value").val();
			var submit_slide = '';
			if(name == ''){
				$("#slide_submit_response").html('<div class="label label-danger">Please select an image to submit</div>');
			}else{
				var formData = new FormData();
				formData.append("image", image);
				formData.append("header", header);
				formData.append("content", content);
				formData.append("submit_value", submit_value);
				formData.append("submit_slide", submit_slide);
				formData.append("hostel_id", hostel_id);
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:formData,
				contentType:false,
				cache:false,
				processData:false,
				success:function(data){
					alert(data);
					$("#slide_submit_response").html(data).fadeOut(5000);
					$("#slide_image").val('');
					$("#post_image_slideshow_form")[0].reset();
					GetSlideShowImages();
				}
			});
			}
		});
	//VALIDATING UPLOADED SLIDE IMAGE
		$("#slide_image").on("change", function(){
			var property = document.getElementById("slide_image").files[0];
			var change_slide_image='';
			var name = property.name;
			var size = property.size;
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['jpg','jpeg','png']) == -1){
				alert("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#slideResponse").text("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#slide_image").val("");
			}else if(size > 1000000){
				alert("File is too large!Only a maximum of 1MB is required!");
				$("#slideResponse").text("File is too large!Only a maximum of 1MB is required!").fadeOut(5000);
				$("#slide_image").val("");
			}
		});
	//ROOMS TABS
		$("#rooms_tabs").tabs();
	//DELETING ROOMS FROM THE DATABASE
		$(document).on('click','.delete_room',function(){
			var room_del_id = $(this).attr("id");
			var delete_hostel_room = '';
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{room_del_id:room_del_id,delete_hostel_room:delete_hostel_room},
				success:function(data){
					alert(data);
					available_rooms.ajax.reload(true);
				},
			})
		})
	//POPULATING THE ADD ROOM NUMBER FORM WITH DATABASE VALUES TO EDIT THE AVAILABLE ROOM DETAILS
		$(document).on('click','.edit_available_room',function(){
			var room_edit_id = $(this).attr("id");
			var view_room_form_details = '';
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{room_edit_id:room_edit_id,view_room_form_details:view_room_form_details},
				success:function(data){
					$("#room_number").val(data.rm_no);
					$("#room_amount").val(data.rm_amount);
					$("#add_room").modal('show');
				}
			})
		})
	//ROOMS TABLE
		var view_available_rooms = '';
		var available_rooms = $("#available_rooms_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_available_rooms
					:view_available_rooms,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[3],
				"orderable":false,
			}],
			"pageLength":25
		});
	//CHANGING ROOMS PHOTOS
		$(".room_photo").on('change', function(){
			var room_photo_id = $(this).attr("id");
			var file = document.getElementById(room_photo_id).files[0];
			var singleName = file.name;
			var size = file.size;
			var ext = singleName.split('.').pop().toLowerCase();
			var change_room_photo = '';
			if(jQuery.inArray(ext, ['jpg','jpeg']) == -1){
				alert("Invalid image file!Only jpg/jpeg images allowed!");
			}else if(size > 1000000){
				alert("File size is too large!Only a maximum of 1MB is allowed!");
			}else{
				var formData = new FormData();
				formData.append("change_room_photo",file);
				formData.append("room_id",room_photo_id);
				formData.append("hostel",hostel_id);
				$.ajax({
					url:'ajax.php',
					method:"POST",
					data:formData,
					contentType:false,
					cache:false,
					processData:false,
					beforeSend:function(){
						$('.room_image_response').html("<label class='text-danger'>Image uploading.......</label>");
					},
					success:function(data){
						$('.room_image_response').html("<label class='text-success'>Image successfully uploaded</label>");
						document.location.reload(true);
					}
				})

			}
		});
///////////////////////////////////////////////////////////////////////ACCOUNTS SECTION//////////////////////////////////////////////////////
	//ACCOUNT NAMES TABLE
		var view_accounts_types = '';
		var accounts_types_table = $("#account_names_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_accounts_types:view_accounts_types,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[3],
				"orderable":false,
			}],
			"pageLength":25
		});
	//DELETING TRANSACTIONS FROM THE DATABASE
		$(document).on('click','.trans_del',function(){
			var trans_id = $(this).attr("id");
			var delt_transaction = '';
			if(confirm("Are you sure you want to delete this transaction?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{trans_id:trans_id,delt_transaction:delt_transaction},
				success:function(data){
					alert(data);
					transaction_table.ajax.reload(true);
				}
			});
			}
		});
	//TRANSACTION SUMMARY TABLE
		/*var view_transaction_summary = '';
		var transaction_summary_table = $("#transaction_summary_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_transaction_summary:view_transaction_summary,hostel_id:hostel_id},
			},
			"pageLength":25
		});*/
	//TRANSACTIONS TABLE
		var view_transaction_table = '';
		var transaction_table = $("#transactions_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_transaction_table:view_transaction_table,hostel_id:hostel_id},
			},
			"pageLength":25
		});
	//CLIENTS PAYMETNT TABLE
		var view_clients_payment_table = '';
		var clients_payment_table = $("#clients_payment_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_clients_payment_table:view_clients_payment_table,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[5,6],
				"orderable":false,
			}],
			"pageLength":25
		});
	//BALANCES TABLE
		var view_balances_table = '';
		var balances_table = $("#clients_balances_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_balances_table:view_balances_table,hostel_id:hostel_id},
			},
			"pageLength":25
		});
	//EDITNG PAYMENTS DETAILS
		$(document).on('click','.pedit',function(){
			var payid = $(this).attr("id");
			var edit_payment = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{payid:payid,edit_payment:edit_payment},
				dataType:"json",
				success:function(data){
					$("#id").val(data.id_no);
					$("#amount").val(data.amount);
					$("#pay").modal("show");
				}
			})
			
		})
	//DELETING AN ACCOUNT IN THE ACCOUNT TYPES SECTION
		$(document).on('click','.acname_dlt',function(){
			var acnm = $(this).attr("id");
			var delete_account_types = '';
			if(confirm("Are you sure you want to delete this clients information?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{acnm:acnm},
				success:function(data){
					alert(data);
					accounts_types_table.ajax.reload(true);
				}
			});
			}
		});
	//DELETING PAYMENT DETAILS
		$(document).on('click','.pdelete',function(){
			var payment_id = $(this).attr("id");
			var delete_payment = '';
			if(confirm("Are you sure you want to delete this payment?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{payment_id:payment_id,delete_payment:delete_payment},
				success:function(data){
					alert(data);
					document.location.reload(true);
				}
			});
			}
		});
	//EDITING TRANSACTIONS DETAILS
		$(document).on('click','.trans_edit',function(){
			var trans_id = $(this).attr("id");
			var edit_trans_details = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{trans_id:trans_id,edit_trans_details:edit_trans_details},
				dataType:"json",
				success:function(data){
					$("#account_title").html('<option value="'+data.acn_id+'">'+data.acn_name+'</option>');
					$("#trans_desc").val(data.description);
					$("#trans_amount").val(data.amount);
					$(".modal-title").text("Edit transaction");
					$("#submitTransaction").val("Edit transaction");
					$("#transaction").modal("show");
				}
			})
		});
///////////////////////////////////////////////////////////////////////UNIVERSITY ADMINS SECTION////////////////////////////////////////////
	//HOSTELS LIST TABLE
		var view_hostels_list = '';
		var hostelsTable = $("#hostel_lists").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_hostels_list:view_hostels_list},
			},
			"pageLength":25
		});
	//STUDENTS LISTS
		var view_students_list = '';
		var university = $("#uni_id").val();
		var hostelsTable = $("#student_lists").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_students_list:view_students_list,university:university},
			},
			"pageLength":25
		});
///////////////////////////////////////////////////ADMIN SECTION DETAILS///////////////////////////////////////
	//Users telephone number
		$("#phone").intlTelInput();
	//ADD USER BUTTON
		$("#add_user_button").click(function(){
			$("#insert_admins_form")[0].reset();
			$("#addusers").modal('show');
		})
	//ADMINS TABLE SECTION
		var view_system_admins = '';
		var system_users_table = $("#system_users").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_system_admins:view_system_admins,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[5,6,7],
				"orderable":false,
			}],
			"pageLength":25
		});
	//DELETING ADMINS INFORMATION FROM THE DATABASE
		$(document).on('click','.admin_delete',function(){
			var adDel = $(this).attr("id");
			if(confirm("Are you sure you want to delete this user?")){
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{adDel:adDel},
					success:function(data){
						system_users_table.ajax.reload(true);
					}
				});
			}
		})
	//ACTIVATING AND DEACTIVATING ADMINISTRATORS
		$(document).on('click','.admin_state',function(){
			var adId = $(this).attr("id");
			var change_admin_status = "Change admin status";
			if(confirm('Are you sure you want to change the status of the admin!')){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{adId:adId,hostel_id:hostel_id,change_admin_status:change_admin_status},
				success:function(data){
					$("#adminStatus").html(data);
					document.location.reload(true);
				}
			});
			}
		});
	//EDITING AND SAVING ADMIN DETAILS TO THE DATABASE
		$("#insert").click(function(e){
			e.preventDefault();
			var insert_admin_action = "insert_admin";
			var btn_action = $("#btn_action").val();
			var fname = $("#fname").val();
			var sys_id = $('#user_id').val();
			if($("#radio_admin").prop('checked')){
				var user_type = $("#radio_admin").val();
			}else{
				var user_type = $("#radio_user").val();
			}
			var lname = $('#lname').val();
			var email =	$('#email').val();
			var phone = $('#phone').val();
			var password = $('#password').val();
			if(!ValidateSingleName('fname','fnameresponse') || !ValidateSingleName('lname','lnameresponse') || !ValidateEmail('email','emailresponse') || !ValidateTel('phone','phoneresponse')){
				$("#admin_insertdata_response").html('<div class="alert alert-danger">Please ensure all fields are valid before submission of the form</div>').fadeOut(20000);
			}else{
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{hostel_id:hostel_id,user_type:user_type,insert_admin_action:insert_admin_action,btn_action:btn_action,fname:fname,sys_id:sys_id,lname:lname,email:email,phone:phone,password:password},
					success:function(data){

						$("#admin_insertdata_response").html(data).fadeOut(20000);
						$("#insert_admins_form")[0].reset();
						system_users_table.ajax.reload(true);
					}
				})
			}
		});
	//CHANGING THE ADMINS PROFILE IMAGE
		$("#adminProfile").on("change", function(){
			var admnId = $("#admnId").val();
			var property = document.getElementById("adminProfile").files[0];
			var name = property.name;
			var size = property.size;
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['jpg','jpeg','png']) == -1){
				alert("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#admnProfileResponse").text("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#adminProfile").val("");
			}else if(size > 1000000){
				alert("File is too large!Only a maximum of 1MB is required!");
				$("#admnProfileResponse").text("File is too large!Only a maximum of 1MB is required!");
				$("#adminProfile").val("");
			}else{
				var formData = new FormData();
				formData.append("changeAdminProfile", property);
				formData.append("changeadmnProfileId", admnId);
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:formData,
					contentType:false,
					cache:false,
					processData:false,
					beforeSend: function(){
						$("#admnProfileResponse").html("<label class='text-danger'>Image uploading.....................</label>");
					},
					success: function(data){
						$(".admnProfileImg").attr('src', data);
						$("#admnProfileResponse").html("<label class='text-success'>Image uploaded successfully</label>");
						$("#adminProfile").val("");
					}
				});
			}
		});
	//EDITING SYSTEM USERS DETAILS
		$(document).on('click', '.edit_sysuser', function(){
			var sys_id = $(this).attr("id");
			var edit_admin = "edit admin";
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{sys_id:sys_id,edit_admin:edit_admin},
				dataType:"json",
				success:function(data){
					$('#user_id').val(data.admin_id);
					$('#fname').val(data.admin_FName);
					$('#lname').val(data.admin_LName);
					$('#email').val(data.admin_Email);
					$('#phone').val(data.phone);
					if(data.user == 'admin'){
						$('#radio_admin').attr('checked','checked');
					}else{
						$('#radio_user').attr('checked','checked');
					}
					$('#user').val(data.admin_usertype);
					$('.modal-title').text("Edit Admin");
					$('#insert').val("Update admins details");
					$('#password').attr('disabled','disabled');
					$("#btn_action").val("Edit");
					$('#addusers').modal('show');
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
				url:"ajax.php",
				method:"POST",
				data:{rmcatid:rmcatid},
				success:function(data){
					$("#rm_no").html("<option>Please select a room number</option>"+data);
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
//////////////////////////////////////////////////SUPPLIER SECTION INFORMATION//////////////////////////////////////////////////////////
	//SUPPLIERS TABLE
		var view_suppliers_table = '';
		var suppliers_table = $("#suppliers_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_suppliers_table:view_suppliers_table,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[3],
				"orderable":false,
			}],
			"pageLength":25
		});
	//INVOICE TABLE
		var view_invoice_table = '';
		var invoice_table = $("#invoice_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_invoice_table:view_invoice_table,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[8,9,10],
				"orderable":false,
			}],
			"pageLength":25
		});
	//DELETING SUPPLIERS
		$(document).on('click','.s_delete',function(){
			var sid = $(this).attr("id");
			var delete_supplier = '';
			if(confirm("Are you sure you want to delete this supplier?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{sid:sid,delete_supplier:delete_supplier},
				success:function(data){
					alert(data);
					suppliers_table.ajax.reload(true);
				}
			});
			}
			
		});
	//EDITING SUPPLIETS DETAILS
		$(document).on('click',".s_edit",function(){
		var supid = $(this).attr("id");
		var edit_supplier = '';
		$.ajax({
			url:"ajax.php",
			method:"POST",
			data:{supid:supid,edit_supplier:edit_supplier},
			dataType:"json",
			success:function(data){
				$("#fname").val(data.f_name);
				$("#lname").val(data.l_name);
				$("#phone").val(data.phone);
				$("#email").val(data.email);
				$("#idno").val(data.idno);
				$("#product").val(data.product);
				$(".modal-title").text("Edit supplier");
				$("#submit_supplier").val("Edit supplier information");
				$("#supplier").modal("show");
			}
		})
		})
	//EDITING SUPPLIETS DETAILS
		$(document).on('click',".edit_supplies",function(){
			var suplyid = $(this).attr("id");
			var edit_supplies = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{suplyid:suplyid,edit_supplies:edit_supplies},
				dataType:"json",
				success:function(data){
					$("#supply_amount").val(data.amount);
					$(".modal-title").text("Edit supply");
					$("#submit_supply").val("Edit supply information");
					$("#supplies").modal("show");
				}
			})
		});
	//DELETING AN INVOICE
		$(document).on('click','.inv_delete',function(){
			var inv_id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this invoice?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{inv_id:inv_id},
				success:function(data){
					alert(data);
					invoice_table.ajax.reload(true);
				}
			});
			}
			
		});
/////////////////////////////////////////////////////VACANCE SECTION DETAILS/////////////////////////////////////////////
	///GETTING VACANCY DETAILS FROM THE DATABASE AND FILLING IT TO THE FORMSECTION
		$(".vacance_edit").click(function(){
			var vacance_id = $(this).attr("id");
			var edit_vacance = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{vacance_id:vacance_id,edit_vacance:edit_vacance},
				dataType:"json",
				success:function(data){
					$("#vid").val(data.vaca_id);
					$("#title").val(data.vaca_title);
					//$("#content[name='content']").html(data.vaca_details);
					CKEDITOR.instances['content'].setData(data.vaca_details);
					$("#edit_vacance_modal").modal("show");
				}
			})
			
		});
	//DELETING THE VACANCE FROM THE DATABASE
		$('.vacance_delete').click(function(){
			var vac_id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this vacance?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{vac_id:vac_id},
				success:function(data){
					alert(data);
					document.location.reload(true);
				}
				});
			}
			});
	/////POSTING VACANCY EDITED DATA TO THE DATABASE
		$("#post_vacancy").click(function(e){
			e.preventDefault();
			var vid = $("#vid").val();
			var title = $("#title").val();
			var content = $("#content").val();
			var submit_vacancy = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{vid:vid,title:title,content:content,submit_vacancy:submit_vacancy},
				success:function(data){
					$("#edit_vacacncy_content")[0].reset();
					$(".message").html(data);
					setTimeout(function(){
						$("#edit_vacance_modal").modal("hide").fadeOut('slow');
						$(".message").html('');
					},1000)
				}
			})
			
		})
//////////////////////////////////////////////////////BLOG SECTION////////////////////////////////////////////////////////
	//DELETING A BLOG
		$('.delBlog').click(function(){
			var bId = $(this).attr("id");
			if(confirm("Are you sure you want to delete this blog?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{bId:bId},
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
//////////////////////////////////////////////CLIENTS SECTION//////////////////////////////////////////////////////
	//GURADIANS TEL NUMBER
		$("#pphone").intlTelInput();
	//SAVE CLIENTS ROOM NUMBER
		$("#save_room_number").click(function(e){
			e.preventDefault();
			var room_amount = $("#room_amount").val();
			var room_cat = $("#room_cat").val();
			var room_number = $("#room_number").val();
			var save_roomnumber = '';
			if(!ValidateSelectCombo('room_cat','roomcatresponse') || !ValidateVariousCharacters('room_number',1,10,'roomnoresponse') || !ValidateNumerals('room_amount',2,5,'room_amount_response')){
				$("#room_form_response").html('<div class="alert alert-danger">Please ensure all fields are valid before submission</div>').fadeOut(20000);
			}else{
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{hostel_id:hostel_id,room_amount:room_amount,room_cat:room_cat,room_number:room_number,save_roomnumber:save_roomnumber},
					success:function(data){
						$("#room_form_response").html(data).fadeOut(20000);
						$("#room_form")[0].reset();
					}
				})
			}
		});
	//SAVE CLIENTS INSTITUTION
		$("#save_institution").click(function(){
			var institution = $("#institution_name").val();
			var save_insitution = '';
			if(!ValidateVariousCharacters('institution_name',5,0,'institution_response')){
				$("#institution_form_response").html("<div class='alert alert-danger'>Please ensure the fields are complete before submitting the form</div>").fadeOut(10000);
			}else{
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{institution:institution,save_institution:save_institution},
					success:function(data){
						$("#institution_form_response").html(data).fadeOut(10000);
						$("#institution_form")[0].reset();
					}
				})
			}
		})
	//CLIENTS TABLE SECTION
		var view_clients = '';
		var clients_table = $("#clients_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_clients:view_clients,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[5,6,7],
				"orderable":false,
			}],
			"pageLength":25
		});
	//CHECKED IN CLIENTS TABLE
		var view_checkedin_clients = '';
		var checkedin_clients_table = $("#checkedin_clients_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_checkedin_clients:view_checkedin_clients,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[5,6,7],
				"orderable":false,
			}],
			"pageLength":25

		});
	//CHECKED OUT CLIENTS TABLE
		var view_checkedout_clients = '';
		var checkedout_clients_table = $("#checkedout_clients_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_checkedout_clients:view_checkedout_clients,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[5,6,7],
				"orderable":false,
			}],
			"pageLength":25

		});
	//VIEWING THE CLIENTS ADD MODAL WINDOW
		$("#add_client").click(function(){
			$("#customerForm")[0].reset();
			$("#edit_client_modal").modal('show');
		})
	//CHANGING CLIENTS PROFILE IMAGE
		$(document).on('#change_client_profile','change',function(){
			alert('Hello');
		})
	//POPULATING CLIENTS DATA TO THE EDIT AND ADD MODAL WINDOW
		$(document).on('click','.client_edit',function(){
			var cid = $(this).attr("id");
			var edit_cliet_details = "Edit client";
			var hostel_list = $(this).data("hostellist");
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{cid:cid,edit_cliet_details:edit_cliet_details},
				dataType:"json",
				success:function(data){
					if(data.passport == ''){
						$("#client_profile").html('<h5>Change clients profile picture</h5><img src="images/default.png" width="100px" height="100px" style="border-radius:50%;" /><input type="file" id="change_client_profile" />');
					}else{
						$("#client_profile").html('<img src="images/'+data.passport+'" width="100px" height="100px" style="border-radius:50%;"/><input type="file" id="change_client_profile" />');
					}
					if(data.gender == 'm'){
						$('#m').attr('checked','checked');
					}else if(data.gender == 'f'){
						$('#f').attr('checked','checked');
					}
					$('#hostel_list').val(hostel_list);
					$('#cl_id').val(data.cl_id);
					$('#fname').val(data.fname);
					$('#lname').val(data.lname);
					$('#cphone').val(data.phone);
					$('#cnumber').val(data.id_no);
					$('#email').val(data.email);
					$('#institution').val(data.uni_id);
					$('#uni_name').text(data.uni_name);
					$('#pname').val(data.pname);
					$('#pphone').val(data.pphone);
					$('#course').val(data.course);
					$('#discount').val(data.discount);
					$('#action').val('edit');
					$('.modal-title').text('Edit client\'s details');
					$('#edit_client').val('Edit client\'s details');
					$('#edit_client_modal').modal("show");
				}
			});
		});
	//VIEWING THE CLIENTS DETAILS
		$(document).on('click','.view_data',function(){
			var cid = $(this).attr("id");
			var view_client_details = "view clients details";
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{cid:cid,view_client_details:view_client_details},
				success:function(data){
					$("#client_details").html(data);
					$('#cdetails').modal("show");
				}
			});
		});
	//CHECKING IN AND OUT OF CLIENTS
		$(document).on('click','.check',function(){
			var chsid = $(this).attr("id");
			var changeClientStatus = "Change clients status";
			if(confirm('Are you sure you want to change the clients status')){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{chsid:chsid,changeClientStatus:changeClientStatus},
				success:function(data){
					alert(data);
					clients_table.ajax.reload(true);
					checkedin_clients_table.ajax.reload(true);
					checkedout_clients_table.ajax.reload(true);
				}
			});
			}
		});
	//EDITING AND SAVING CLIENTS INFORMATION TO THE DATABASE
		$("#edit_client").click(function(){
			var hostel_list = $("#hostel_list").val();
			var cl_id = $("#cl_id").val();
			var fname = $("#fname").val();
			var lname = $("#lname").val();
			var cphone = $("#cphone").val();
			if($("#m").prop('checked')){
				var gender = $("#m").val(); 
			}else{
				var gender = $("#f").val();
			}
			var cnumber = $("#cnumber").val();
			var email = $("#email").val();
			var institution = $("#institution").val();
			var pname = $("#pname").val();
			var pphone = $("#pphone").val();
			var room_no = $("#rm_no").val();
			var action = $("#action").val();
			var course = $("#course").val();
			var discount = $("#discount").val();
			var edit_client = '';
			if(!ValidateSingleName('fname','fnameresponse') || !ValidateSingleName('lname','lnameresponse') || !ValidateTel('cphone','phoneresponse') || !ValidateNumerals('cnumber',8,8,'idresponse') || !ValidateEmail('email','emailresponse') || !ValidateSelectCombo('institution','institutionresponse') || !ValidateFullNames('pname','pnameresponse') || !ValidateTel('pphone','pphoneresponse') || !ValidateSelectCombo('croom','roomresponse') || !ValidateSelectCombo('croom','roomresponse') || !ValidateSelectCombo('rm_no','roomnoresponse' || !ValidateNumerals('discount',0,12,'discountresponse'))){
					$("#edit_client_response").html('<div class="alert alert-danger">Please ensure the input fields are valid before submission</div>').fadeOut(20000);
			}else{
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{hostel_list:hostel_list,cl_id:cl_id,fname:fname,lname:lname,cphone:cphone,cnumber:cnumber,email:email,institution:institution,pname:pname,pphone:pphone,room_no:room_no,edit_client:edit_client,action:action,hostel_id:hostel_id,course:course,gender:gender,discount:discount},
					success:function(data){
						$("#edit_client_response").html(data).fadeOut(20000);
						clients_table.ajax.reload(true);
						
					}
				})
			}
		});
	//DELETING CLIENTS INFORMATION FROM THE DATABASE
		$(document).on('click','.delete',function(){
			var cid = $(this).attr("id");
			var delete_client = "Delete client";
			if(confirm("Are you sure you want to delete this clients information?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{cid:cid,delete_client:delete_client},
				success:function(data){
					alert(data);
					clients_table.ajax.reload(true);
				}
			});
			}
		});
////////////////////////////////////////////////////////EMPLOYEES SECTION///////////////////////////////////////////////////////////////////////
	//UPDATING EMPLOYEES PROFILE PICTURE
		$("#change_employees_profile_pic").on("change", function(){
			alert("Hello");
			var empId = $("#employeeid").val();
			var property = document.getElementById("change_employees_profile_pic").files[0];
			var name = property.name;
			var size = property.size;
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['jpg','jpeg','png']) == -1){
				alert("Invalid image extension! Only 'jpg/jpeg/png allowed!'");
				$("#employeeProfileResponse").html("<lable class='text-danger'>Invalid image extension! Only 'jpg/jpeg/png allowed!'</label>");
				$("#change_employees_profile_pic").val("");
			}else if(size > 1000000){
				alert("File is too large!Only a maximum of 1MB is required!");
				$("#employeeProfileResponse").html("<label class='text-danger'>File is too large!Only a maximum of 1MB is required!");
				$("#adminProfile").val("");
			}else{
				var formData = new FormData();
				formData.append("changeEmployeeProfile", property);
				formData.append("changeEmployeeProfileId", admnId);
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:formData,
					contentType:false,
					cache:false,
					processData:false,
					beforeSend: function(){
						$("#employeeProfileResponse").html("<label class='text-danger'>Image uploading.....................</label>");
					},
					success: function(data){
						$("#employee_profile_image").attr('src', data);
						$("#employeeProfileResponse").html("<label class='text-success'>Image uploaded successfully</label>");
						$("#change_employees_profile_pic").val("");
					}
				});
			}
		});
	//EMPLOYEES TABLE CONTENT
		var view_employees = '';
		var employees_table = $("#employees_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_employees:view_employees,hostel_id:hostel_id},
			},
			"columnDefs":[{
				"target":[5,6,7],
				"orderable":false,
			}],
			"pageLength":25

		});
	//EMPLOYEES SALARY TABLE
		var view_employees_salary = '';
		var salary_table = $("#emp_salary_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ajax.php",
				method:"POST",
				data:{view_employees_salary:view_employees_salary,hostel_id:hostel_id},
			},
			"pageLength":25

		});
	//DELETING THE EMPLOYEES
		$(document).on('click','.emp_del',function(){
			var emp = $(this).attr("id");
			if(confirm("Are you sure you want to delete this employee?")){
				$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{emp:emp},
				success:function(data){
					alert(data);
					employees_table.ajax.reload(true);
				}
			});
			}
			
		});
	//DELETING EMPLOYEES SALARY DETAILS
		$(document).on('click','.sal_delete',function(){
			var del_sal_id = $(this).attr("id");
			var delete_salary = '';
			if(confirm("Are you sure you want to delete this employees salary details?")){
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{del_sal_id:del_sal_id,delete_salary:delete_salary},
					success:function(data){
						alert(data);
						salary_table.ajax.reload(true);
					},
				});
			}
		});
	//POPULATING THE SALARY INPUT BOX WITH SALARY VALUE
		$("#employee_id_salary").change(function(){
			var idno = $(this).val();
			var get_employee_salary = '';
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{idno:idno,get_employee_salary:get_employee_salary},
				success:function(data){
					alert(data);
					$("#employee_salary").val(data);
				}
			})
		})
	//EDITING EMPLOYEES DETAILS
		$(document).on('click','.edit_employees',function(){
			var emp_id = $(this).attr("id");
			var edit_employees_form_data = "Edit employees form data";
			$.ajax({
				url:"ajax.php",
				method:"POST",
				data:{emp_id:emp_id,edit_employees_form_data:edit_employees_form_data},
				dataType:"json",
				success:function(data){
					if(data.emp_passport == ''){
						$("#employee_image_section").html('<h3>Change employee profile image</h3>'+'<img src="images/default.png" id="employee_profile_image" width="100px" height="100px" />'+' '+'<input type="file" id="change_employees_profile_pic"/>');
					}else{
						/*$("#employee_image_section").html('<h3>Change employee profile image</h3>'+'<img src="images/default.png" id="employee_profile_image" width="100px" height="100px" />'+' '+'<input type="file" id="employees_profile_pic"/>');*/
					}
					$("#fname").val(data.emp_fname);
					$("#lname").val(data.emp_lname);
					$("#phone").val(data.emp_phone);
					$("#email").val(data.emp_email);
					$("#idno").val(data.emp_idno);
					$("#salary").val(data.emp_salary);
					$("#employeeid").val(data.emp_id);
					$("#btnaction").val('edit');
					$(".modal-title").text("Edit employees details");
					$(".edit_button").val("Edit employee details")
					$("#employees").modal("show");
				}
			})
		})
	//INSERTING EMPLOYEES DATA TO THE DATABASE
		$('#edit_employee').click(function(e){
			e.preventDefault();
			var fname = $("#fname").val();
			var lname = $("#lname").val();
			var phone = $("#phone").val();
			var email = $("#email").val();
			var idno = $("#idno").val();
			var salary = $("#salary").val();
			var employeeid = $("#employeeid").val();
			var btnaction = $("#btnaction").val();
			var editemployeedetails = '';
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data:{hostel_id:hostel_id,fname:fname,lname:lname,phone:phone,email:email,idno:idno,salary:salary,employeeid:employeeid,btnaction:btnaction,editemployeedetails:editemployeedetails},
				success:function(data){
					$("#employeeresponse").html(data);
					setTimeout(function(){
						$("#employees").modal("hide").fadeOut("slow");
						$("#employeesform")[0].reset();
						$("#employeeresponse").html('');
					}, 2000);
					employees_table.ajax.reload(true);
				}
			})

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
	//ENSURING THE ID NUMBER EXISTS BEFORE POSTING PAYMENT
		$("#id").blur(function(){
			var idNo = $(this).val();
			var check_id_payment = '';
			if(idNo != ''){
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{idNo:idNo,check_id_payment:check_id_payment,hostel_id:hostel_id},
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
	//LOADING DATA TO THE ADMIN SECTION USING BUTTONS TO SHOW ADMIN DETAILS
		$('#adminArea').load('edit_account.php');
		$('#adminHeader ul li a').click(function(){
			var page = $(this).attr('href');
			$('adminArea').load('../admin/'+ page + '.php');
		});
});
