<?php Ccc::loadClass('Controller_Core_Action');?>

<?php
class Controller_Config extends Controller_Core_Action
{
	
	public function gridAction()
	{	
		$content = $this->getLayout()->getContent();
		$config = Ccc::getBlock('Config_Grid');
		$content->addChild($config);
		$this->renderLayout();
	}

	public function addAction()
	{
		$config = Ccc::getModel('Config');
		$content = $this->getLayout()->getContent();
		$config = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
		$content->addChild($config);
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
			$content = $this->getLayout()->getContent();
			$config = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
			$content->addChild($config);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,true);
		}
		
	}
	
	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			if(!$request->isPost() || !$request->getPost('config')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			

			$row = $request->getPost('config');
			if (array_key_exists('configId', $row))
			{
				if(!(int)$row['configId'])
				{
					throw new Exception("Invalid Id.", 1);
				}
				$config = Ccc::getModel('Config')->load($row['configId']);
			}
			else
			{
				$config = Ccc::getModel('Config');
				$config->createdAt = date('Y-m-d H:i:s');
			}

			$config->setData($row);
			$config = $config->save();
			if (!$config) 
			{
				throw new Exception("System is unable to save config.", 1);
			}

			$this->getMessage()->addMessage('Config saved Successfully.');
			$this->redirect('grid',null,null,true);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$config = Ccc::getModel('Config')->load($id);
			if(!$config)
			{
				throw new Exception("Record not found.", 1);
			}
			
			$delete = $config->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
			}

			$this->getMessage()->addMessage('Config Deleted Successfully.');
			$this->redirect('grid',null,null,true);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,true);	
		}
	}
}