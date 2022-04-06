<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Config extends Controller_Admin_Action
{
	
	public function indexAction()
	{
		$this->setPageTitle('ConfigPage');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{	
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$configBlock = Ccc::getBlock('Config_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $configBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
	}

	public function addAction()
	{
		$this->setPageTitle('Config Add');
		$config = Ccc::getModel('Config');
		Ccc::register('config',$config);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$configBlock = Ccc::getBlock('Config_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $configBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
		// $content = $this->getLayout()->getContent();
		// $config = Ccc::getBlock('Config_Edit');
		// $content->addChild($config);
		// $this->renderLayout();
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
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$configBlock = Ccc::getBlock('Config_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $configBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);
			// $content = $this->getLayout()->getContent();
			// $config = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
			// $content->addChild($config);
			// $this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->gridAction();
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
			$this->gridAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->gridAction();
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
			$this->gridAction();					
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->gridAction();					
		}
	}

	public function multipleDeleteAction()
	{
		try 
		{
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if(!$request->isPost('delete'))
			{
				throw new Exception("Invalid Request.", 1);				
			}
			
			$row = $request->getPost('delete');
			if (array_key_exists('all',$row)) 
			{
				$query = "DELETE FROM `config`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `config` WHERE `configId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('Config detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}