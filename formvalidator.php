<?php
	class validator{
		//for storing form fields names
		private $fields = array();
		//for storing errors for form fields
		private $fieldErrors = array();
		private $formIsValid = true ;
		public function addField($fieldName){
			$this->fields[] = $fieldName;
			$this->fieldErrors[$fieldName] = array();
		}
		public function addRuleToField($fieldName, $fieldRule){
			$ruleName = $fieldRule[0];
			switch($ruleName){
				case 'min_length':
					if(strlen($fieldName) < $fieldRule[1]){
						$this->addErrorToField($fieldName, "Please this field cannot be less than {$fieldRule[1]} in length");
					}
				break;
				//ENSURING THE FIELDS ARE NOT EMPTY WHEN BEING POSTED
				case 'empty':
					if(strlen($_POST[$fieldName]) == 0){
						$this->addErrorToField($fieldName, "Please this field cannot be empty");
					}
				break;
				//ALLOWING SINGLE NAMES TO HAVE ONLY ALPHABETIC CHARACTERS
				case 'sname':
				if(!preg_match('/^[A-Za-z\-\'\-\.]$/', $fieldName)){
					$this->addErrorToField($fieldName, "Please only alphabetic characters are required");
				}
				break;
				//ONLY ALLOWING LETTERS AND WHITESPACES TO BE ENTERED IN THE NAME FIELD
				case 'name':
					$pattern = '/^[A-Za-z ]$/';
					if(preg_match($pattern,$fieldName)){
						
					}else{
						$this->addErrorToField($fieldName, ucwords($fieldName)." Allows only letters and white spaces!");
					}
				break;
				//VALIDATING EMAIL ADDRESS
				case 'valemail':
					if(!preg_match("%^[A-Za-z0-9._\-\']+@[A-Za-z0-9._\-]+\.[A-Za-z]{2,4}$%",$fieldName)){
						$this->addErrorToField($fieldName, ucwords($fieldName)." Please enter a valid email address");
					}
				break;
				//VALIDATING NUMBERS
				case 'num':
					if(!preg_match("/^[0-9]*$/",$fieldName)){
						$this->addErrorToField($fieldName, ucwords($fieldName)." Please only digits 0-9 are allowed here");
					}
				break;
				//PASSWORD VALIDATION
				case 'pass':
				if(!preg_match('%^?=[-_a-zA-Z0-9]*?[A-Z])(?=[-_a-zA-Z0-9]*?[a-z])(?=[-_a-zA-Z0-9]*?[0-9])\S{6,}$%')){
					$this->addErrorToField($fieldName, "Please the password field requires atleast 6 characters which contains atleast 1 special,small, capital and a digit character!");
				}
				default:
				break;
			}
		}
		private function addErrorToField($fieldName, $errorMessage){
			$this->formIsValid = false;
			$this->fieldErrors[$fieldName][] = $errorMessage;
		}
		public function formValid(){
			return $this->formIsValid;
		}
		public function outPutFieldError($fieldName){
			if(isset($this->fieldErrors[$fieldName])){
				foreach($this->fieldErrors[$fieldName] as $fieldError){
					echo "<b><i><p class='error' style='color:#FF0000;'>{$fieldError}</p></i></b>";
				}
			}
		}
		public function outPutAllFieldErrors(){
			foreach($this->fields as $fields){
				$this->outPutFieldError($fields);
			}
		}

	}
?>