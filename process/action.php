<?php 

require '../class/connect.php';

$con = new db();

if (isset($_POST['isset_delete'])) {
	$delete_id = $_POST['delete_id'];

	$con->delete_data($delete_id);

}else if (isset($_POST['search_isset'])) {
	$search_value =  $_POST['search_value'];
	$con->search_result($search_value);
}






?>