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
					WHERE id='".$row['id']."'";
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
		$this->redirect("Category.php?a=gridAction");
		
		} catch (Exception $e) {
			$this->redirect("Category.php?a=gridAction");	
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
			$query = "DELETE FROM Category WHERE id = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.", 1);
				
			}
			$this->redirect("Category.php?a=gridAction");		
		} catch (Exception $e) {
			$this->redirect("Category.php?a=gridAction");		
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

$category = new Category();
$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$category->$action(); 
?>