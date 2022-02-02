<?php
	include 'C:\xampp\htdocs\PHP\Practice\AdapterClass\Adapter.php';
	$a = new Adapter();
	$conn=$a->connection();
	$id=$_GET['id'];

	$del = $a->delete("delete from Product where id = ".$id); 
	if($del)
	{

		?>
		echo
		<script type='text/javascript'>
			alert('Product Deleted successsfully..!!');
		
		window.location="Product-grid.php";
		</script>
		<?php
			
	}
	else
	{
		echo mysqli_error();
	}

	
	mysqli_close($conn);
?>