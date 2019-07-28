// FUNCTION TO GENERATE ERRORS AND DISPLAY
		function produceError(message,error_div,field_id,color){
			error_div.innerHTML = message;
			error_div.style.color = color;
			field_id.style.borderColor = color;
		}
//VALIDATING INPUT FIELDS WITH BOTH FIRST AND LAST NAME
		var ValidateFullNames = function(field_id,error_div){
			var field_id = document.getElementById(field_id);
			var full_name = field_id.value;
			var error_div = document.getElementById(error_div);
			if(full_name.length == 0){
				produceError('This fied cannot be empty',error_div,field_id,'red');
				return false;
			}else if(!full_name.match(/^[A-Za-z]{2,20}\s{1}[A-Za-z]{2,20}$/)){
				produceError('Please enter first and last name with a single space between it <i> e.g Larry Page</b>',error_div,field_id,'red');
				return false;
			}else{
				produceError('',error_div,field_id,'green');
				return true;
			}
		}
//VALIDATION OF A PARAGRAPHS
		var ValidateVariousCharacters = function(field_id,min_char,max_char,error_div){
				var field_id = document.getElementById(field_id);
				var field_value = field_id.value;
				var error_div = document.getElementById(error_div);
				if(field_value.length == 0){
					produceError('This fied cannot be empty',error_div,field_id,'red');
				}else if(min_char > 0 & field_value.length < min_char){
					var left = min_char - field_value.length;
					produceError(left+' more characters required',error_div,field_id,'red');
					return false;
				}else if(max_char > 0 & field_value.length > max_char){
					produceError('Only a maximum of '+max_char+' characters is required!. <i><b>Your total characters is '+field_value.length+'<b></i>',error_div,field_id,'red');
					return false;
				}else{
					produceError('',error_div,field_id,'green');
					return true;
				}
		}
//VALIDATING MOBILE PHONE NUMBER
	var ValidateTel = function(field_id,error_div){
		var field_id = document.getElementById(field_id);
		var error_div = document.getElementById(error_div);
		var phone = field_id.value;
		if(phone.length == 0){
			produceError('This field cannot be empty',error_div,field_id,'red');
			return false;
		}else if(!phone.match(/^[0-9+()\-]{6,15}/)){
			produceError('Please enter a valid phone number e.g+254722222222(Select country flag to give you a structure of the phone number)',error_div,field_id,'red');
			return false;
		}else{
				produceError('',error_div,field_id,'green');
				return true;
		}
	}
//VALIDATING CDKEDITOR TEXTA REA CHARACTERS
	var ValidateCkEditor = function(field_value,error_div){
		var error_div = document.getElementById(error_div);
		if(field_value.length == 0){
			produceError('This field cannot be empty!',error_div,field_id,'red');
		}
	}
//VALIDATING NUMERIC VALUES
	var ValidateNumerals = function(field_id,min_val,max_val,error_div){
		var field_id = document.getElementById(field_id);
		var error_div = document.getElementById(error_div);
		var field_val = field_id.value;
		if(field_val.length == 0){
			produceError('This field cannot be empty',error_div,field_id,'red');
			return false;
		}else if(field_val.length < min_val){
			produceError('This field allows a minimum of '+min_val+' digits',error_div,field_id,'red');
			return false;
		}else if(!field_val.match(/^[0-9\.]*$/)){
			produceError('This field allows only numeric values 0-9',error_div,field_id,'red');
			return false;
		}else if(field_val.length > max_val){
			produceError('This field allows a maximum of '+max_val+' digits',error_div,field_id,'red');
			return false;
		}else{
			produceError('',error_div,field_id,'green');
			return true;
		}
	}
//VALIDATE SINGLE NAMES
	var ValidateSingleName = function(field_id,error_div){
		var field_id = document.getElementById(field_id);
		var name = field_id.value;
		var error_div = document.getElementById(error_div);
		if(name.length == 0){
			produceError('This fied cannot be empty',error_div,field_id,'red');
			return false;
		}else if(!name.match(/^[A-Za-z'\-]{2,20}$/)){
			produceError('Please enter a valid name e.g<b><i> Mike (Digits and special symbols are not allowed)</i></b>',error_div,field_id,'red');
			return false;
		}else{
			produceError('',error_div,field_id,'green');
			return true;
		}
	}
//EMAIL VALIDATION
	var ValidateEmail = function(field_id,error_div){
		var field_id = document.getElementById(field_id);
		var email = field_id.value;
		var error_div = document.getElementById(error_div);
		if(email.length == 0){
			produceError('This fied cannot be empty',error_div,field_id,'red');
			return false;
		}else if(!email.match(/^([A-Za-z0-9\.\_\-:]{2,20})\@(['A-Za-z']{2,8})\.([A-Za-z]{2,8})$/)){
			produceError('Please enter a valid email address e.g<b><i> admin@gmail.com</i></b>',error_div,field_id,'red');
			return false;
		}else{
			produceError('',error_div,field_id,'green');
			return true;
		}
	}
//PASSWORD VALIDATION
	var ValidatePassword = function(field_id,error_div){
		var field_id = document.getElementById(field_id);
		var pass = field_id.value;
		var error_div = document.getElementById(error_div);
		if(pass.length == 0){
			produceError('This fied cannot be empty',error_div,field_id,'red');
			return false;
		}else if(pass.length < 6){
			produceError('A minimum of six characters is required',error_div,field_id,'red');
			return false;
		}else{
			produceError('',error_div,field_id,'green');
			return true;
		}
	}	
//INPUT SELECT VALIDATION
	var ValidateSelectCombo = function(field_id,error_div){
		var field_id = document.getElementById(field_id);
		var field_val = field_id.value;
		var error_div = document.getElementById(error_div);
		if(field_val.length == 0){
			produceError('Please select a field',error_div,field_id,'red');
			return false;
		}else{
			produceError('',error_div,field_id,'green');
			return true;
		}
	}