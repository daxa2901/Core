<?php Ccc::loadClass('Controller_Core_Action');?>

<?php
class Controller_Admin extends Controller_Core_Action
{
	
	public function gridAction()
	{	
		$session = Ccc::getModel('Core_Session');
		// $session->name = 'session1<br>';
		// echo $session->name;
		// $session->value = 'value<br>';
		// echo $session->value;
		$session->destroy();
		// $session->start();
		// var_dump($session->getId());
		// echo $session->regenerateId();
		// print_r($session;
		// $content = $this->getLayout()->getContent();
		// $adminRow = Ccc::getBlock('Admin_Grid');
		// $content->addChild($adminRow);
		// $this->renderLayout();
	}

	public function addAction()
	{
		$admin = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) 
      		{
      			throw new Exception("Invalid Id.", 1);
      		}
			$admin = Ccc::getModel('Admin')->load($id);
      		if (!$admin) 
      		{
      			throw new Exception("Unable to Load Admin.", 1);
      		}
      		$content = $this->getLayout()->getContent();
			$adminRow = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
			$content->addChild($adminRow);
			$this->renderLayout();

		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid',null,null,true));
			//echo $e->getMessage();
		}
		
	}
	
	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$adminRow = Ccc::getModel('Admin');
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('admin')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			

			$row = $request->getPost('admin');
			if (array_key_exists('adminId', $row))
			{
				if(!(int)$row['adminId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$adminRow->setData($row);
				$adminRow->updatedDate = date('Y-m-d H:i:s');
				$update = $adminRow->save();
				if(!$update)
				{ 
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
				$adminRow->setData($row);
				$adminRow->createdDate = date('Y-m-d H:i:s');
				$insert = $adminRow->save($row);
				if(!$insert)
				{	
					throw new Exception("System is unable to insert.", 1);
				}
				
			}
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid',null,null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{	$adminRow = Ccc::getModel('Admin');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$id=$request->getRequest('id');
			$adminRow = $adminRow->load($id);
			if(!$adminRow)
			{
				throw new Exception("Record not found.", 1);
			}
			$delete = $adminRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid',null,null,true));	
		}
	}
}