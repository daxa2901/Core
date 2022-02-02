<?php
	include 'C:\xampp\htdocs\PHP\Practice\AdapterClass\Adapter.php';
	$id=$_GET['id'];

	$del = $adapter->delete("delete from Product where id = ".$id); 
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
?>