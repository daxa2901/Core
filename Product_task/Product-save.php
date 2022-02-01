<?php
$con= mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"Product");

	if(isset($_POST['update']))
	{
		
						
					$sql="update Product set id='".$_POST['id']."', name='".$_POST['name']."',price=".$_POST['price'].",
					quantity='".$_POST['quantity']."',createdAt='".$_POST['createdAt']."',updatedAt='".$_POST['updatedAt']."',status='".$_POST['status']."' where id='".$_POST['id']."'";
					
					$res=$con->query($sql);
					if(!$res)
					{
							echo mysqli_error();
					}
					else
					{
						?>
						echo "<script type='text/javascript'>alert('Product Info Update successsfully..!!');</script>";
														
						<script type="text/javascript">window.location="Product-grid.php";
						</script>
						<?php

					}
	}
	if(isset($_POST['add']))
	{
		
						
					$sql="insert into Product Values('".$_POST['id']."','".$_POST['name']."',".$_POST['price'].",
					'".$_POST['quantity']."','".$_POST['createdAt']."','".$_POST['updatedAt']."','".$_POST['status']."')";
					
					$res=$con->query($sql);
					if(!$res)
					{
							echo mysqli_error();
					}
					else
					{
						?>
						echo "<script type='text/javascript'>alert('Product Info Inserted successsfully..!!');</script>";
														
						<script type="text/javascript">window.location="Product-grid.php";
						</script>
						<?php

					}
	}

	if(isset($_POST['cancel']))
	{
		?>
		<script type="text/javascript">
			window.location="Product-grid.php";
		</script>
		<?php
	}
		mysqli_close($con);	

?>