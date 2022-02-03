<?php
	require_once('C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php');

class Customer{
	public function gridAction()
	{
		require_once('Customer-grid.php');
	}

	public function addAction()
	{
		require_once('Customer-add.php');
	}

	public function editAction()
	{
		require_once('Customer-edit.php');
	}

	public function saveAction()
	{
		global $adapter;
		if($_POST['customer_id']){
			$upd = $adapter->update("update Customer set firstName='".$_POST['firstName']."',lastName='".$_POST['lastName']."',email='".$_POST['email']."',mobile='".$_POST['mobile']."',status='".$_POST['status']."',updatedAt='".$adapter->currentDate()."' where customer_id='".$_POST['customer_id']."'");
			if($upd){ ?>
				<script type='text/javascript'>
					alert('Customer Info Update successsfully..!!');
					window.location="Customer.php?a=gridAction";
				</script>
			<?php

			}
		}
		else{

			$res=$adapter->insert("insert into Customer(name,createdAt,status) Values('".$_POST['name']."','".$adapter->currentDate()."','".$_POST['status']."')");
			if($res){	?>
				<script type='text/javascript'>
					alert('Customer Info Inserted successsfully..!!');
					window.location="Customer.php?a=gridAction";
				</script>
			<?php

			}
		}
	}

	public function deleteAction()
	{
		global $adapter;
		$id=$_GET['id'];
		$del = $adapter->delete("delete from Customer where id = ".$id); 
		if($del)
		{
			?>
			
			<script type='text/javascript'>
				alert('Customer Deleted successsfully..!!');
				window.location="Customer.php?a=gridAction";
			</script>
			<?php			
		}	
	}

	public function errorAction()
	{
		echo "error";
	}
}

$customer = new Customer();
$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$customer->$action(); 
?>