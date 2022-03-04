<?php Ccc::loadClass('Controller_Core_Action');?>

<?php
class Controller_Config extends Controller_Core_Action
{
	
	public function gridAction()
	{	
		$content = $this->getLayout()->getContent();
		$configRow = Ccc::getBlock('Config_Grid');
		$content->addChild($configRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$config = Ccc::getModel('Config');
		$content = $this->getLayout()->getContent();
		$configRow = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
		$content->addChild($configRow);
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
			$config = Ccc::getModel('Config')->load($id);
			if (!$config) 
      		{
      			throw new Exception("Unable to Load Config.", 1);
      		}
      		$config = Ccc::getModel('Config')->load($id);
			$content = $this->getLayout()->getContent();
			$configRow = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
			$content->addChild($configRow);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$messages = $this->getMessage();
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
		}
		
	}
	
	public function saveAction()
	{
		try
		{
			$messages = $this->getMessage();
			$configRow = Ccc::getModel('Config');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('config')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			

			$row = $request->getPost('config');
			if (array_key_exists('configId', $row))
			{
				if(!(int)$row['configId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$configRow->setData($row);
				$update = $configRow->save();
				if(!$update)
				{ 
					throw new Exception("System is unable to update.", 1);
				}
				$messages->addMessage('Config Updated Successfully.');
				
			}
			else
			{
				$configRow->setData($row);
				$configRow->createdAt = date('Y-m-d H:i:s');
				$insert = $configRow->save();
				if(!$insert)
				{	
					throw new Exception("System is unable to insert.", 1);
				}
				$messages->addMessage('Config Inserted Successfully.');
			}
			$this->redirect('grid',null,null,true);
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$messages = $this->getMessage();
			$configRow = Ccc::getModel('Config');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id=$request->getRequest('id');
			$configRow = $configRow->load($id);
			if(!$configRow)
			{

				throw new Exception("Record not found.", 1);
			}
			$delete = $configRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$messages->addMessage('Config Deleted Successfully.');
			$this->redirect('grid',null,null,true);	
				
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);	
		}
	}
}