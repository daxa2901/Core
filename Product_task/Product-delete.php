<?php
	$con= mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"Product");
	$id=$_GET['id'];

	$sql="delete from Product where id=".$id;
	$res=$con->query($sql);
	if($res)
	{
		?>
		echo
		<script type='text/javascript'>
			alert('Product Deleted successsfully..!!');
		
		window.location="Product-grid.php";
		</script>
		<?php
			
	}
	
	mysqli_close($con);
?>