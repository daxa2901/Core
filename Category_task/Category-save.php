<?php
	include 'C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php';


	if($_POST['id']){
		$upd = $adapter->update("update Category set name='".$_POST['name']."',price=".$_POST['price'].",quantity='".$_POST['quantity']."',updatedAt='".$adapter->currentDate()."',status='".$_POST['status']."' where id='".$_POST['id']."'");
		if($upd){
			?>
			<script type='text/javascript'>
				alert('Category Info Update successsfully..!!');
				window.location="Category-grid.php";
			</script>
			<?php

		}
	}
	else{
		$res=$adapter->insert("insert into Category(name,price,quantity,createdAt,updatedAt,status) Values('".$_POST['name']."',".$_POST['price'].",'".$_POST['quantity']."','".$adapter->currentDate()."','".$adapter->currentDate()."','".$_POST['status']."')");
		if($res){
			?>
			<script type='text/javascript'>
				alert('Category Info Inserted successsfully..!!');
				window.location="Category-grid.php";
			</script>
			<?php

		}
	}
?>