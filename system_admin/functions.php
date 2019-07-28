<?php
	include ("db.php");
	//GETTING MESSAGES FROM THE MESSAGE TABLE AND DISPLAYING IT TO THE ADMIN TABLE
	function getMessage(){
		global $con;
		$get_message = "select * from messages";
		$run_mes = mysqli_query($con, $get_message);
		while($row_mes = mysqli_fetch_array($run_mes)){
			$mes_id = $row_mes['mes_id'];
			$mes_name = $row_mes['mes_name'];
			$mes_phone = $row_mes['mes_phone'];
			$mes_city = $row_mes['mes_city'];
			$mes_sub = $row_mes['mes_sub'];
			$message = $row_mes['message'];
			$mes_date = $row_mes['date'];
			echo "<div>
				<b>From:</b> $mes_name <br />
				<b>Phone:</b> $mes_phone <br />
				<b>City:</b>$mes_city <br />
				<b>Subject:</b>$mes_sub <br />
				$message<br /><br />
				<i><b>The message was sent on: $mes_date</b></i>
				<hr style='width:100%; color:#808080;'/>
			</div>
			";
		}
	}
	//POSTING THE HOSTELS IMAGES IN THE DATABASES 
	function hostImageResize($target,$newCopy,$w,$h,$ext){
		list($wOrig, $hOrig) = getimagesize($target);
		$scaleRatio = $wOrig/$hOrig;
		if(($w/$h) > $scaleRatio){
			$w = $h * $scaleRatio;
		}else{
			$h = $w/$scaleRatio;
		}
		$img = "";
		if($ext=="gif" || $ext=="GIF"){
			$img=imagecreatefromgif($target);
		}elseif($ext=="png" || $ext=="PNG"){
			$img=imagecreatefrompng($target);
		}else{
			$img=imagecreatefromjpeg($target);
		}
		$tci = imagecreatetruecolor($w,$h);
		imagecopyresampled($tci,$img,0,0,0,0,$w,$h,$wOrigin,$hOrigin);
		$img=imagejpeg($tci,$newCopy,100);
		
	}
?>