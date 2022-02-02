<?php
	include 'C:\xampp\htdocs\PHP\Practice\AdapterClass\Adapter.php';
	$a = new Adapter();
	$conn=$a->connection();
	
	if(isset($_POST['update']))
	{
					echo $_POST['id'];
					$upd = $a->update("update Product set id='".$_POST['id']."', name='".$_POST['name']."',price=".$_POST['price'].",
					quantity='".$_POST['quantity']."',createdAt='".$_POST['createdAt']."',updatedAt='".$_POST['updatedAt']."',status='".$_POST['status']."' where id='".$_POST['id']."'");
					if(!$upd)
					{
						echo mysqli_error();
					}
	
					else
					{
						?>
						<script type='text/javascript'>alert('Product Info Update successsfully..!!');</script>;
														
						<script type="text/javascript">window.location="Product-grid.php";
						</script>
						<?php

					}
	}
	if(isset($_POST['add']))
	{
		
						
					$res=$a->insert("insert into Product(name,price,quantity,createdAt,updatedAt,status) Values('".$_POST['name']."',".$_POST['price'].",'".$_POST['quantity']."','".$_POST['createdAt']."','".$_POST['updatedAt']."','".$_POST['status']."')");
					
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
		mysqli_close($conn);	

?>