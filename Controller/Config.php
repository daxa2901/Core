<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Admin'); ?>
<?php
class Controller_Admin extends Controller_Core_Action
{
	
	public function gridAction()
	{	
		Ccc::getBlock('Config_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Config_Add')->toHtml();
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
			$config = Ccc::getModel('Config')->load($id);
			if (!$config) 
      		{
      			throw new Exception("Unable to Load Admin.", 1);
      		}
     		Ccc::getBlock('Config_Edit')->addData('config',$config)->toHtml();

		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));
			//echo $e->getMessage();
		}
		
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
			if (!$request->getPost('admin')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			

			$row = $request->getPost('admin');
			$adminTable = Ccc::getModel('Admin');
			if (array_key_exists('adminId', $row))
			{
				if(!(int)$row['adminId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$row['updatedDate'] = date('Y-m-d H:i:s');
				$id = $row['adminId'];
				unset($row['adminId']);
				$update = $adminTable->update($row,['adminId'=>$id]);
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
				$row['createdDate'] = date('Y-m-d H:i:s');
				$adminTable = Ccc::getModel('Admin');
				$insert = $adminTable->insert($row);
				if(!$insert)
				{	
					throw new Exception("System is unable to insert.", 1);
				}
				
			}
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));
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
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));	
		}
	}
}