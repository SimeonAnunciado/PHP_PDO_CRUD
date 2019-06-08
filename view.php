<?php  
require 'class/connect.php';

$con = new db();

if (isset($_GET['id'])) {
	
	$get_explode = explode(';', $_GET['id']);
	$id = $get_explode[1];


	$con->update_data($id);
	$datas = $con->select_employee($id);

	extract($datas);



}
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
						// if(!empty($con->error_msg)){
						// 	echo "<div class='alert alert-danger'>" .$con->error_msg . "</div>";
						// }
						?>
						

						<form action="" method="post">
							<input type="hidden" class="form-control" name="id" placeholder="id" value="<?php echo $id; ?>" >

							<div class="form-group">
								<input type="text" class="form-control" name="name" placeholder="name" value="<?php echo $name; ?>" >
							</div>
							<div class="form-group">
								<input type="number" class="form-control" name="age" placeholder="age" value="<?php echo $age; ?>" >
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="designated" placeholder="designated" value="<?php echo $department; ?>" >
							</div>
							<button name="update" class="btn btn-block btn-primary">UPDATE</button>
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