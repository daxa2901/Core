<?php
	require_once('Model\Core\Adapter.php');

class Controller_Admin{
	public function gridAction()
	{
		require_once('view/admin/grid.php');
	}

	public function addAction()
	{
		require_once('view/admin/add.php');
	}

	public function editAction()
	{
		require_once('view/admin/edit.php');
	}
	
	public function saveAction()
	{
		try
		{
			if (!isset($_POST['admin'])) {
				throw new Exception("Invalid Request.", 1);				
			}			
			global $adapter;
			global $date;
			$row = $_POST['admin'];

			if (array_key_exists('adminId', $row)) {
				if(!(int)$row['adminId']){
					throw new Exception("Invalid Request.", 1);
				}
				$adminId = $row["adminId"];
				$query = "UPDATE Admin 
					SET firstName='".$row['firstName']."',
						lastName='".$row['lastName']."',
						email='".$row['email']."',
						password='".$row['password']."',
						mobile='".$row['mobile']."',
						status='".$row['status']."',
						updatedDate='".$date."' 
					WHERE adminId='".$adminId."'";

				$update = $adapter->update($query);
				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else{
				if($row['password'] !=$row['confirmPassword'])
				{
					throw new Exception("password must be same.", 1);

				}
				$query = "INSERT INTO admin(firstName,lastName,email,mobile,status,createdDate) 	
				VALUES('".$row['firstName']."',
						   '".$row['lastName']."',
						   '".$row['email']."',
						   '".$row['mobile']."',
						   '".$row['status']."',
						   '".$date."')";
				$adminId=$adapter->insert($query);
				if(!$adminId)
				{	
						throw new Exception("System is unable to insert.", 1);
				}
				
			}
			$this->redirect('index.php?c=admin&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=admin&a=grid');
		}
	}

	public function deleteAction()
	{
		try 
		{	
			if (!isset($_GET['id'])) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter;
			$id=$_GET['id'];
			$query = "DELETE FROM Admin WHERE adminId = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=admin&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('admin.php?a=gridAction');	
			//echo $e->getMessage();
		}

		
	}

	public function redirect($url)
	{
	
		header('location:'.$url);	
		exit();			
	}

	public function errorAction()
	{
		echo "errorAction";
	}
}
?>