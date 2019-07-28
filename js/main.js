//Hostels admin side bar menu function
//915186
$(document).ready(function(){
	//if($(window).scrollTop() >= $(document).height() -  )
	/*$(window).on('scroll', function(){
		var h1 = $(window).scrollTop();
		var h2 = $(document).height();
		var h3 = $(window).height();
		$('#window').text('scroll-'+h1);
		$('#window-h').text('window-height-'+h3)
		$('#document').text('document-'+h2);
		var h4 = h2 - h3;
		$('#diff').text('diff-'+h4);
	})*/
	
////////////////////////////////////BLOG SECTION///////////////////////////////////////////////////
	//SEARCHING BLOG
		$("#search_blog").keyup(function(){
			var search_blog = $(this).val();
			$.ajax({
				url:'ajax.php',
				method:'POST',
				data: {search_blog:search_blog},
				success:function(data){
					if(data == ''){
						$("#blog_section").html('<div class="alert alert-danger">No result found</div>');
					}else{
						$("#blog_section").html(data);
					}	
				}
			});
		})
	//LOADING BLOG CONTENT
		var blogLimit = 5;
		var blogStart = 0;
		var b_act = 'inactive';
		if(b_act == 'inactive'){
			b_act = 'active';
			LoadBlog(blogLimit,blogStart);
		}
		
		function LoadBlog(blogLimit,blogStart){
			$.ajax({
				url:'ajax.php',
				method:'GET',
				cache:false,
				data:{blogLimit:blogLimit,blogStart:blogStart},
				/*beforeSend:function(){
					$("#load_blog").html('<img src="images/loading.gif" class="img-responsive" width="100px" height="100px" />')
				},*/
				success:function(data){
					if(data == ''){
						b_act = 'active';
					}else{
						$("#blog_section").append(data);
						b_act = 'inactive';
					}
				}
			})
		}
/////////////////////////////////////MOBILE PHONE INTL VALIDATION////////////////////////////////////
	$("#cphone").intlTelInput();
//ADDING SEARCH BOX TO SELECT INPUT TAG
	$('select').select2();
//////////////////////////////////////CONTACT US PAGE////////////////////////////////////////////////
	$("#sendContactMessage").click(function(e){
		e.preventDefault();
		var name = $("#fullname").val();
		var phone = $("#cphone").intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164,"aggressive");
		var subject = $("#subject").val();
		var message = CKEDITOR.instances['message'].getData();
		var submit_contact_message = '';
		if(message.length == 0){
			$("#messageresponse").html("<span style='color:red;'>Please enter a message</span>")
		}else{
			$("#messageresponse").html('');
			if(!ValidateFullNames('fullname','fname_response') || !ValidateVariousCharacters('subject',0,50,'subjectresponse') || !ValidateTel('cphone','phoneresponse')){
				$("#contact_us_form_response").html('<span style="color:red;">Please ensure all the fields are valid before submission</span>');
			}else{
				$.ajax({
					url:'ajax.php',
					method:'POST',
					data:{name:name,phone:phone,subject:subject,message:message,submit_contact_message:submit_contact_message},
					success:function(data){
						alert('Records have been successfully submitted');
						$("#contact_us_form_response").html(data).fadeOut(20000);
						$("#contact_us_form")[0].reset();
					}
				})
			}
		}
	})
/////////////////////////////////////////////////////////////SYSTEM ADMIN SECTION STYLING////////////////
	//CREATING A STICKY SIDEBAR
		simpleStickySidebar('.sidebar-inner', {
	  		container: '.sidebar',
	  		topSpace: 150,
	  		bottomSpace : 150
		});
	//CREATING A STICKY SIDEBAR
		simpleStickySidebar('.sidebar-inner2', {
	  		container: '.sidebar2',
	  		topSpace: 150,
	  		bottomSpace : 150
		});
	//DELETING MESSAGES IN ADMIN SECTION
		$(".delete_message").click(function(){
			var mes_id = $(this).attr("id");
			var delete_message = '';
			if(confirm('Are you sure you want to delete this record!')){
				$.ajax({
					url:'../ajax.php',
					method:'POST',
					data:{mes_id:mes_id,delete_message:delete_message},
					success:function(data){
						alert(data);
					}
				});
			}
		})
	//POPPING UP THE HELP SUPPORT MODAL WINDOW BY CLICKING THE ADD BUTTON
		$("#add_help_support").click(function(){
			$("#help_support_form")[0].reset();
			$("#help_support").modal('show');
		});
	//ADDING HELP AND SUPPORT DATA TO THE DATABASE
		$("#save_help_support").click(function(){
			var title = $("#title").val();
			var id_attr = $("#id_attr").val();
			var title_sum = $("#title_sum").val();
			var content = $("#content").val();
			var save_help_support = '';
			var btn_action = $("#btn_action").val();
			var s_id = $("#support_id").val();
			$.ajax({
				url:'../ajax.php',
				method:'POST',
				data:{title:title,id_attr:id_attr,title_sum:title_sum,content:content,save_help_support:save_help_support,btn_action:btn_action,s_id:s_id},
				success:function(data){
					$("#help_support_response").html(data).fadeOut(10000);
					$("#help_support_form")[0].reset();
					//help_support.ajax.reload(true);
					help_support.ajax.reload(true);
				}
			})
		})
	//POPULATING THE EDIT HELP AND SUPPORT FORM WITH DATA
		$(document).on('click','.edit_help_support',function(){
			var help_support_id = $(this).attr("id");
			var help_support_data = '';
			$.ajax({
				url:"../ajax.php",
				method:"POST",
				data:{help_support_id:help_support_id,help_support_data:help_support_data},
				dataType:"json",
				success:function(data){
					$("#title").val(data.help_title);
					$("#id_attr").val(data.id_attr);
					$("#title_sum").val(data.title_summary);
					$("#content").val(data.help_content);
					$("#help_support").modal('show');
					$("#btn_action").val('edit');
					$("#support_id").val(data.s_id);
				}
			});
		});
	//DELETING HELP SUPPORT
		$(document).on('click','.delete_help_support',function(){
			var help_support_id = $(this).attr("id");
			var delete_help_support = '';
			if(confirm('Are you sure you want to delete this record!')){
				$.ajax({
					url:'../ajax.php',
					method:'POST',
					data:{help_support_id:help_support_id,delete_help_support:delete_help_support},
					success:function(data){
						alert(data);
						help_support.ajax.reload(true);
					}
				})
			}
		});
	///////////////POPULATING HELP AND SUPPORT CONTENT TO THE TABLE
		var view_help_support = '';
		var help_support = $("#help_support_table").DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"../ajax.php",
				method:"POST",
				data:{view_help_support
					:view_help_support},
			},
			"columnDefs":[{
				"target":[3],
				"orderable":false,
			}],
			"pageLength":25
		});
////////////////////////////////////////////////////////////////HOME PAGE SECTION/////////////////////////////////////////////////
	//LOADING MOEW HOSTELS INFORMATION WITH AJAX
		function FindCategory(){
			var fullUrl = window.location.search.substring(1);
			if(fullUrl == ''){
				var val = 'unavailable';
				return val;
			}else{
				var cat = fullUrl.split('=');

				return cat[1];
			}
		}
		var category = FindCategory();
		var limit = 12;
		var start = 0;
		var action = 'inactive';
		function LoadHostels(limit, start){
			$.ajax({
				url:'ajax.php',
				method:'GET',
				data:{limit:limit,start:start,category:category},
				cache:false,
				success: function(data){
					if(data == 'unavailable'){
						$("#hostels_section").append('<br /><br /><div style="margin:auto; margin-top:20px; margin-bottom:20px;" class="alert alert-danger">CURRENTLY THERE IS NO DATA FOR THIS CATEGORY. IT WILL BE UPDATED VERY SOON!</div> <br /><br />');
					}else{
						$("#hostels_section").append(data);
						if(data == ''){
							action = 'active';
						}else{
							action = 'inactive';
						}
					}
				}
			});
		}
		if(action == 'inactive'){
			action = 'active';
			LoadHostels(limit, start);
		}
	//SCROLLING FUNCTION TO LISTEN FOR ALL SCROLL ACTIVITIES ON THE PAGE
		$(window).scroll(function(){
			if(($(window).scrollTop()+200) >= ($(document).height() - $(window).height())  && action == 'inactive'){
				action = 'active';
				start = start + limit;
				//setTimeout(function(){
					LoadHostels(limit, start);
				//}, 1000);
				
			}
			if(($(window).scrollTop()+200) >= ($(document).height() - $(window).height())  && b_act == 'inactive'){
				b_act = 'active';
				blogStart = blogStart + blogLimit;
				//setTimeout(function(){
					LoadBlog(blogLimit, blogStart);
				//}, 1000);
				
			}
		});
	//SEARCHING THE HOSTELS DATABASE FOR HOSTELS
		$("#hostelSearch").keyup(function(){
			var query = $(this).val();
			if(query != ''){
				$.ajax({
					url:"ajax.php",
					method:"POST",
					data:{query:query},
					success:function(data){
						$('#hostels_section').fadeIn("slow");
						$('#hostels_section').html(data);
					}
				});
			}
		});
	//MOBILE NAVIGATION MENU
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
					url:'admin.php?view_clients',
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
	//ENSURING THE HEIGHT OF ALL IMAGES ARE EQUALI 
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
	//ENSURING THE HEIGHT OF ALL HOSTELS ARE EQUAL
		$(function(){
				var tallest = 0;
				$columnsToEqualize = $(".hostels_home_display");
				$columnsToEqualize.each(function(){
					var thisHeight = $(this).height();
					if(thisHeight > tallest){
						tallest = thisHeight;
					}
				});
				$columnsToEqualize.height(tallest);
		});
	});

