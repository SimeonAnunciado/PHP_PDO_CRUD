<?php 

class Pagination extends db{
	 /* paging */




	public function dataview($query){
		$stmt = $this->con_db()->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0){
			$counter = 1;
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				$password_hash_id = password_hash($row['id'],PASSWORD_DEFAULT) . ';' .$row['id'] .';' .password_hash($row['id'],PASSWORD_DEFAULT);
			?>
			            <tr>
			            <td><?php echo $row['name']; ?></td>
			            <td><?php echo $row['age']; ?></td>
			            <td><?php echo $row['department']; ?></td>
		            	<td align="center">
		            		<a href="view.php?id=<?php echo $password_hash_id; ?>" class="btn btn-success">View</a>
		            		<a href="#" class="btn btn-danger" onclick="return delete_data(this.id);" 
		            		id="<?php echo $row['id']; ?>">Remove</a>
		            	</td>
		            	
			            </tr>
			            <?php
			}
		}else{
		?>
		        <tr>
		        <td>No Data Found...</td>
		        </tr>
		        <?php
		}

	}
	 
	 public function paging($query,$records_per_page){
	  $starting_position=0;
	  if(isset($_GET["page_no"])){
	   $starting_position=($_GET["page_no"]-1)*$records_per_page;
	  }
	  $query2=$query." limit $starting_position,$records_per_page";
	  return $query2;
	 }
	 
	 public function paginglink($query,$records_per_page){
	  
	  $self = $_SERVER['PHP_SELF'];
	  
	  $stmt = $this->con_db()->prepare($query);
	  $stmt->execute();
	  
	  $total_no_of_records = $stmt->rowCount();
	  
	  if($total_no_of_records > 0){
	   ?><ul class="pagination"><?php
	   $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
	   $current_page=1;
	   if(isset($_GET["page_no"])){
	    $current_page=$_GET["page_no"];
	   }
	   if($current_page!=1){
	    $previous =$current_page-1;
	    echo "<li><a href='".$self."?page_no=1'>First</a></li>";
	    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
	   }
	   for($i=1;$i<=$total_no_of_pages;$i++){
	    if($i==$current_page){
	     echo "<li class='active'><a href='".$self."?page_no=".$i."' >".$i."</a></li>";
	    }else{
	     echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
	    }
	   }
	   if($current_page!=$total_no_of_pages){
	    $next=$current_page+1;
	    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
	    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
	   }
	   ?></ul><?php
	  }
	 }
	 
	 /* paging */
	 

}


 ?>