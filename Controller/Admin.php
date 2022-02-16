<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
class Controller_Admin extends Controller_Core_Action{
	
	public function gridAction()
	{	
		$adminTable = Ccc::getModel('Admin');
		$query = "SELECT 
					* 
				FROM Admin";
		$admin = $adminTable-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/admin/grid.php');
		$view->addData('admin',$admin);
		$view->toHtml();
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/admin/add.php')->toHtml();
	}

	public function editAction()
	{
		$adminTable = Ccc::getModel('Admin');
		$request=$this->getRequest();
      	$pid=$request->getRequest('id');
      	$query = "SELECT * FROM Admin  
            WHERE adminId=".$pid;
      	$admin = $adminTable-> fetchRow($query);
      	$view = $this->getView();
		$view->setTemplate('view/admin/edit.php');
		$view->addData('admin',$admin);
		$view->toHtml();
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

			global $date;
			$row = $request->getPost('admin');
			$adminTable = Ccc::getModel('Admin');
			if (array_key_exists('adminId', $row)) {
				if(!(int)$row['adminId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$row['updatedDate'] = $date;
				$id = $row['adminId'];
				unset($row['adminId']);
				$update = $adminTable->update($row,['adminId'=>$id]);
				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else
			{
				if($row['password'] !=$row['confirmPassword'])
				{
					throw new Exception("password must be same.", 1);
				}
				unset($row['confirmPassword']);
				$row['createdDate'] = $date;
				$adminTable = Ccc::getModel('Admin');
				$insert = $adminTable->insert($row);
				if(!$insert)
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
		{	$adminTable = Ccc::getModel('Admin');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$id=$request->getRequest('id');
			$delete = $adminTable->delete(['adminId'=>$id]); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=admin&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('index.php?c=admin&a=grid');	
		}
	}

	public function errorAction()
	{
		echo "errorAction";
	}
}
?>