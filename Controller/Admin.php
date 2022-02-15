<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
class Controller_Admin extends Controller_Core_Action{
	
	public function gridAction()
	{	
		$adminTable = new Model_Admin();
		global $adapter; 
		$query = "SELECT 
					* 
				FROM Admin";
		$admin = $adminTable-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/admin/grid.php');
		$view->addData('admin',$admin);
		$view->toHtml();
		//require_once('view/admin/grid.php');
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/admin/add.php')->toHtml();
		
		//require_once('view/admin/add.php');
	}

	public function editAction()
	{
		global $adapter;
		$adminTable = new Model_Admin();
		$request=$this->getRequest();
      	$pid=$request->getRequest('id');
      	$query = "SELECT * FROM Admin  
            WHERE adminId=".$pid;
      	$admin = $adminTable-> fetchRow($query);
      	$view = $this->getView();
		$view->setTemplate('view/admin/edit.php');
		$view->addData('admin',$admin);
		$view->toHtml();
		//require_once('view/admin/edit.php');
	}
	
	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('admin')) {
				throw new Exception("Invalid Request.", 1);				
			}			
			global $adapter;
			global $date;
			$row = $request->getPost('admin');

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
				$query = "INSERT INTO admin(firstName,lastName,email,password,mobile,status,createdDate) 	
				VALUES('".$row['firstName']."',
						   '".$row['lastName']."',
						   '".$row['email']."',
						   '".$row['password']."',
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
		{	$adminTable = new Model_Admin();
			global $adapter;
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$id=$request->getRequest('id');
			$query = "DELETE FROM Admin WHERE adminId = ".$id;
			$delete = $adminTable->delete(['adminId'=>$id]); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=admin&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('index.php?c=admin&a=grid');	
			//echo $e->getMessage();
		}

		
	}

	public function errorAction()
	{
		echo "errorAction";
	}
}
?>