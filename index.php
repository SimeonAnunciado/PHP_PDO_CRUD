<?php  
require 'class/connect.php';
require 'class/class_pagination.php';

$con = new db();
$pagination = new Pagination();
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

					<?php $datas = $con->select_all_data(); ?>
					
					<a href="add.php" class="btn btn-primary">Add New </a>	<br><br>


					<form>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search..." id="search_btn">
						</div>
					</form>

					 <table class="table table-bordered">
					 	<thead>
					 		<tr>
					 			<th>Name</th>
					 			<th>Age</th>
					 			<th>Designated</th>
					 			<th class="text-center">Action</th>
					 		</tr>
					 	</thead>
					 	<tbody id="tbody_result">

					 		<?php
					 		$query = "SELECT * FROM employee";       
					 		$records_per_page=10;
					 		$newquery = $pagination->paging($query,$records_per_page);
					 		$pagination->dataview($newquery);
					 		?> 
					 		<tr id="page_class">
					 			<td colspan="7" align="right">
					 				<div class="pagination-wrap">
					 					<?php $pagination->paginglink($query,$records_per_page); ?>
					 				</div>
					 			</td>
					 		</tr> 

					 	</tbody>

					 	<tbody id="tbody_result_ajax" style="display: none;">

					 	</tbody>

					 </table>
					
				</div>
			<div class="col-md-2"></div>
		</div>	
	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/ajax.js"></script>

</body>
</html>