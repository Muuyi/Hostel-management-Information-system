<div class="row">
	<div class="col">
		<h3>View messages</h3>
		<?php
			$q = 'SELECT * FROM admins_messages ORDER BY post_date DESC';
			$rQ = mysqli_query($con, $q);
			while($row=mysqli_fetch_array($rQ)){
				echo'
					<div style="background-color:#D3D3D3; padding:10px;">
						<b>From:</b> '.$row['mes_name'].';<br />
						<b>Phone:</b> '.$row['phone'].';<br />
						<b>Subject:</b> '.$row['subject'].';<br />
						'.$row['message'].'
						<p style="text-align:right;"><i><b>Posted on:</b> '.$row['post_date'].'</i></p>
						<button type="button" class="btn btn-danger delete_message" id='.$row['mes_id'].'>Delete</button>
					</div><br />
				';
			}
		?>
	</div>
</div>