<?php
	require_once('C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php');

class Category{
	public function gridAction()
	{
		require_once('Category-grid.php');
	}

	public function addAction()
	{
		require_once('Category-add.php');
	}

	public function editAction()
	{
		require_once('Category-edit.php');
	}

	public function saveAction()
	{
			global $adapter;
			if($_POST['id']){
				$upd = $adapter->update("update Category set name='".$_POST['name']."',updatedAt='".$adapter->currentDate()."',status='".$_POST['status']."' where id='".$_POST['id']."'");
				if($upd){
					?>
					<script type='text/javascript'>
						alert('Category Info Update successsfully..!!');
						window.location="Category.php?a=gridAction";
					</script>
					<?php

				}
			}
			else{

				$res=$adapter->insert("insert into Category(name,createdAt,status) Values('".$_POST['name']."','".$adapter->currentDate()."','".$_POST['status']."')");
				if($res){
					?>
					<script type='text/javascript'>
						alert('Category Info Inserted successsfully..!!');
						window.location="Category.php?a=gridAction";
					</script>
					<?php

				}
			}
	}

	public function deleteAction()
	{
		global $adapter;
		$id=$_GET['id'];
		$del = $adapter->delete("delete from Category where id = ".$id); 
		if($del)
		{
			?>
			
			<script type='text/javascript'>
				alert('Category Deleted successsfully..!!');
				window.location="Category.php?a=gridAction";
			</script>
			<?php			
		}	
	}

	public function errorAction()
	{
		echo "error";
	}
}

$category = new Category();
$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$category->$action(); 
?>