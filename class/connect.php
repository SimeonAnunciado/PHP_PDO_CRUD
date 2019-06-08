<?php 

class db{

	public $error_msg;

	public function __construct(){
		$this->con_db();
	}


	public function con_db(){
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$databse = 'pdo_crud_oop';
		$dsn = "mysql:host={$servername}; dbname={$databse}";

		try {
			$con = new PDO($dsn,$username,$password);
			$con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
			return $con;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function count_data(){

		$str = "SELECT * FROM employee";
		$statement = $this->con_db()->prepare($str);
		$statement->execute();
	
		$rows = $statement->fetch();
		echo count($rows);
	}



	public function select_all_data(){
		$str = "SELECT * FROM employee";
		$statement = $this->con_db()->prepare($str);
		$statement->execute();
		$rows = [];
		while ($row = $statement->fetch()) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function add_employee(){
		if (isset($_POST['submit'])) {
		
			foreach ($_POST as $value) {
				if (empty($value)) {
					$this->error_msg = "Please Required Fields";
				}else{
					unset($this->error_msg);
				}
			}

			$name = $_POST['name'];
			$age = $_POST['age'];
			$designated = $_POST['designated'];

			$data_post = ['name' => $name , 'age' => $age , 'department' => $designated];

			$this->add_new_data($data_post);


		}


	}

	public function add_new_data($data_post){
		$column =  implode(',', array_keys($data_post));
		$values =  implode(', :', array_keys($data_post));

		$sql_query = "INSERT INTO employee ($column) VALUES (:{$values}) ";

		$statement = $this->con_db()->prepare($sql_query);

		// prepared 2 or 3 paramater
		// prepared , prepared values
		// prepared , prepared values , prepared datatype

		foreach ($data_post as $data => $value) {
			$statement->bindValue(':'.$data,$value);
		}

		$result = $statement->execute();

		if ($result) {
			header('location:index.php');
		}



	}

	public function select_employee($id){
		$sql = "SELECT * FROM employee WHERE id = :id ";
		$statement = $this->con_db()->prepare($sql);
		$statement->bindValue(':id',$id);

		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		if ($result) {
			return $result;
		}

	}

	public function update_data($id){
		if (isset($_POST['update'])) {

			$name = $_POST['name'];
			$age = $_POST['age'];
			$designated = $_POST['designated'];

			$data_post = ['name' => $name , 'age' => $age , 'department' => $designated];

			$update_sql = "UPDATE employee SET name = :name , age = :age , department = :department 
						  WHERE id = :id  ";

			$statement = $this->con_db()->prepare($update_sql);

			foreach ($data_post as $data => $value) {
				$statement->bindValue(':'.$data,$value);
			}

			$statement->bindValue(':id' ,$id);

			$result = $statement->execute();

			if ($result) {
				header('location:index.php');
			}

		}
	}

	public function delete_data($id){
		$sql_query = "DELETE FROM employee WHERE id = :id ";
		$statement = $this->con_db()->prepare($sql_query);
		$statement->bindValue(':id',$id);

		$result = $statement->execute();

		if ($result) {
			echo "success delete";
		}else{
			echo "Something went wrong";

		}

	}
 

	public function search_result($search_value){
		$sql_search = "SELECT * FROM `employee` WHERE name LIKE :search_value";
		$statement = $this->con_db()->prepare($sql_search);
		$search_data = "%".$search_value."%";
		$statement->bindValue(':search_value',$search_data);

		$statement->execute();


		if ($statement->rowCount() > 0) {
			while ($row = $statement->fetch()) {
				$password_hash_id = password_hash($row['id'],PASSWORD_DEFAULT) . ';' .$row['id'] .';' .password_hash($row['id'],PASSWORD_DEFAULT);
				echo "
				<tr>
				<td>{$row['name']}</td>
				<td>{$row['age']}</td>
				<td>{$row['department']}</td>
				<td align='center'>
		            		<a href='view.php?id={$password_hash_id}' class='btn btn-success'>View</a>
		            		<a href='#' class='btn btn-danger' onclick='return delete_data(this.id);' 
		            		id='{$row['id']}'>Remove</a>
		            	</td>
		        </td>
				</tr>";
			}
		}else{
			echo "<tr >
			<td colspan='20' align='center' style='color:red'>No data found! </td>
			</tr>";
		}


	}






	public function array_helper($array){
		echo "<pre>".print_r($array,true)."</pre>";
	}




}





?>