	$('#search_btn').on('keyup', function(){
		const search_value = this.value;


		if (this.value === '') {
			$('#tbody_result').show();
			$('#tbody_result_ajax').hide();
		}else{
			$('#tbody_result').hide();
			$('#tbody_result_ajax').show();
			$.ajax({
				url:'process/action.php',
				type:'POST',
				data:{search_isset:1 , search_value :search_value}
			})
			.done(function(data){
				$('#tbody_result_ajax').html(data);
			})
			.fail(function() {
				console.log(`Something went wrong`);
			});


		}
	})


// ajax request
function delete_data(id){

	if (confirm('are you sure you want to delete ? ')) {
		let delete_id = id;


		$.ajax({
			url:'process/action.php',
			type:'POST',
			data:{isset_delete : 1 , delete_id:delete_id}
		})
		.done(data => {
			console.log(data);
			location.reload();
		})
		.fail(error => console.log(error))

		return true;

	}else{
		return false;


	}

}
