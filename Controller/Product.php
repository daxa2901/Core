<?php
	require_once('Model\Core\Adapter.php');

class Controller_Product{
	public function gridAction()
	{
		require_once('view/product/grid.php');
	}

	public function addAction()
	{
		require_once('view/product/add.php');
	}

	public function editAction()
	{
		require_once('view/product/edit.php');
	}

	public function saveAction()
	{
		try {
			if (!isset($_POST['product'])) {
			throw new Exception("Invalid Request.", 1);				
			}
			global $adapter;
			$row = $_POST['product'];
			if (array_key_exists('id', $row)) {
				if(!(int)$row['id']){
					throw new Exception("Invalid Request.", 1);
				}
				$query = "UPDATE Product 
					SET name='".$row['name']."',
						price=".$row['price'].",
						quantity='".$row['quantity']."',
						updatedAt='".$adapter->currentDate()."',
						status='".$row['status']."' 
					Where productId='".$row['id']."'";	
				$update = $adapter->update($query);
				if(!$update){
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
				$query = "INSERT INTO Product(name,price,quantity,createdAt,status) 
				VALUES('".$row['name']."',
					   ".$row['price'].",
					   '".$row['quantity']."',
					   '".$adapter->currentDate()."',
					   '".$row['status']."')";
				$insert=$adapter->insert($query);
				if(!$insert){
					throw new Exception("System is unable to insert.", 1);					
				}
			}
			$this->redirect("index.php?c=product&a=grid");
			
		} catch (Exception $e) {
			$this->redirect("index.php?c=product&a=grid");
		}
	}

	public function deleteAction()
	{
		try {
			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			global $adapter;
			$id=$_GET['id'];
			$query = "DELETE FROM Product WHERE productId = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete){
				throw new Exception("System is unable to delete.", 1);							
			}
			
			$this->redirect("index.php?c=product&a=grid");
		} catch (Exception $e) {
			$this->redirect("index.php?c=product&a=grid");
		}
			
	}
	public function redirect($url)
	{
		header('location:'.$url);	
		exit();			
	}

	public function errorAction()
	{
		echo "error";
	}
}

?>