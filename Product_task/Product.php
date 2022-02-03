<?php
	require_once('C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php');

class Product{
	public function gridAction()
	{
		require_once('Product-grid.php');
	}

	public function addAction()
	{
		require_once('Product-add.php');
	}

	public function editAction()
	{
		require_once('Product-edit.php');
	}

	public function saveAction()
	{
			global $adapter;
			if($_POST['id']){
				$upd = $adapter->update("update Product set name='".$_POST['name']."',price=".$_POST['price'].",quantity='".$_POST['quantity']."',updatedAt='".$adapter->currentDate()."',status='".$_POST['status']."' where id='".$_POST['id']."'");
				if($upd){
					?>
					<script type='text/javascript'>
						alert('Product Info Update successsfully..!!');
						window.location="Product.php?a=gridAction";
					</script>
					<?php

				}
			}
			else{

				$res=$adapter->insert("insert into Product(name,price,quantity,createdAt,status) Values('".$_POST['name']."',".$_POST['price'].",'".$_POST['quantity']."','".$adapter->currentDate()."','".$_POST['status']."')");
				if($res){
					?>
					<script type='text/javascript'>
						alert('Product Info Inserted successsfully..!!');
						window.location="Product.php?a=gridAction";
					</script>
					<?php

				}
			}
	}

	public function deleteAction()
	{
		global $adapter;
		$id=$_GET['id'];
		$del = $adapter->delete("delete from Product where id = ".$id); 
		if($del)
		{
			?>
			
			<script type='text/javascript'>
				alert('Product Deleted successsfully..!!');
				window.location="Product.php?a=gridAction";
			</script>
			<?php			
		}	
	}

	public function errorAction()
	{
		echo "error";
	}
}

$product = new Product();
$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$product->$action(); 
?>