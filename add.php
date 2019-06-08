<?php  
require 'class/connect.php';

$con = new db();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-2"></div>
				<div class="col-md-8">

					<?php $datas = $con->add_employee(); ?>
					
					<a href="index.php" class="btn btn-primary">Back  </a>	<br><br>

					
						<?php 
						if(!empty($con->error_msg)){
							echo "<div class='alert alert-danger'>" .$con->error_msg . "</div>";
						}
						?>
						

						<form action="" method="post">
							<div class="form-group">
								<input type="text" class="form-control" name="name" placeholder="name">
							</div>
							<div class="form-group">
								<input type="number" class="form-control" name="age" placeholder="age">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="designated" placeholder="designated">
							</div>
							<button name="submit" class="btn btn-block btn-primary">SUBMIT</button>
						</form>

					
					 </table>
					
				</div>
			<div class="col-md-2"></div>
		</div>	
	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>