<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Config extends Controller_Admin_Action
{
	
	public function gridAction()
	{	
		$this->setPageTitle('Config Grid');
		$content = $this->getLayout()->getContent();
		$config = Ccc::getBlock('Config_Grid');
		$content->addChild($config);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Config Add');
		$config = Ccc::getModel('Config');
		Ccc::register('config',$config);
		$content = $this->getLayout()->getContent();
		$config = Ccc::getBlock('Config_Edit');
		$content->addChild($config);
		$this->renderLayout();
		
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Config Edit');
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
			Ccc::register('config',$config);
			$content = $this->getLayout()->getContent();
			$config = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
			$content->addChild($config);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
		
	}
	
	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Config Save');
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
			$this->redirect('grid',null,['id'=>null]);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$this->setPageTitle('Config Delete');
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
			$this->redirect('grid',null,['id'=>null]);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);	
		}
	}
}