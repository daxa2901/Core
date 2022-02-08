<?php
	require_once('Model\Core\Adapter.php');

class Controller_Category{
	public function gridAction()
	{
		require_once('view/category/grid.php');
	}

	public function addAction()
	{
		require_once('view/category/add.php');
	}

	public function editAction()
	{
		require_once('view/category/edit.php');
	}

	public function saveAction()
	{
		try {
			if (!isset($_POST['category'])) {
			throw new Exception("Invalid Request.", 1);				
			}
			global $adapter;
			$row = $_POST['category'];
			if (array_key_exists('id', $row)) {
				if(!(int)$row['id']){
					throw new Exception("Invalid Request.", 1);
				}
				$query = "UPDATE Category 
					SET name='".$row['name']."',
						updatedAt='".$adapter->currentDate()."',
						status='".$row['status']."' 
					WHERE categoryId='".$row['id']."'";
				$update = $adapter->update($query);
				if(!$update){
					throw new Exception("System is unable to update.", 1);
				}
			}
			else{
				$query = "INSERT INTO Category(name,createdAt,status) 
					VALUES('".$row['name']."',
						   '".$adapter->currentDate()."',
						   '".$row['status']."')";
				$insert=$adapter->insert($query);
				if(!$insert){
					throw new Exception("System is unable to insert.", 1);			
				}
			}
		$this->redirect("index.php?c=category&a=grid");
		
		} catch (Exception $e) {
			$this->redirect("index.php?c=category&a=grid");	
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
			$query = "DELETE FROM Category WHERE categoryId = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.", 1);
				
			}
			$this->redirect("index.php?c=category&a=grid");		
		} catch (Exception $e) {
			$this->redirect("index.php?c=category&a=grid");		
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