<?php
	include 'C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php';
	$id=$_GET['id'];

	$del = $adapter->delete("delete from Category where id = ".$id); 
	if($del)
	{
		?>
		echo
		<script type='text/javascript'>
			alert('Category Deleted successsfully..!!');
			window.location="Category-grid.php";
		</script>
		<?php			
	}	
?>