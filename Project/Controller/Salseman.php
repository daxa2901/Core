<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php 

class Controller_Salseman extends Controller_Admin_Action
{
	public function indexAction()
	{
		$this->setPageTitle('Admin Page');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{	
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$salsemanBlock = Ccc::getBlock('Salseman_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $salsemanBlock
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
		$this->setPageTitle('Salseman Add');
		$salseman = Ccc::getModel('Salseman');
		Ccc::register('salseman',$salseman);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$salsemanBlock = Ccc::getBlock('Salseman_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $salsemanBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Salseman Edit');
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) 
      		{
      			throw new Exception("Invalid Id.", 1);
      		}

			$salseman = Ccc::getModel('salseman')->load($id);
      		if (!$salseman) 
      		{
      			throw new Exception("Unable to Load salseman.", 1);
      		}

			Ccc::register('salseman',$salseman);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$salsemanBlock = Ccc::getBlock('Salseman_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $salsemanBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);

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
			$this->setPageTitle('Salseman Save');
			$request = $this->getRequest();
			if(!$request->isPost() || !$request->getPost('salseman'))
			{
				throw new Exception("Invalid Request", 1);
			}
			$row = $request->getPost('salseman');
			if(array_key_exists('salsemanId',$row))
			{
				if(!(int)$row['salsemanId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$salseman = Ccc::getModel('Salseman')->load($row['salsemanId']);
				$salseman->updatedAt = date('Y-m-d H:i:s');
			}
			else
			{
				$salseman = Ccc::getModel('Salseman');
				$salseman->createdAt = date('Y-m-d H:i:s');
				
			}
			$salseman->setData($row);
			$salseman = $salseman->save();
			if (!$salseman) 
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			Ccc::register('salseman',$salseman);
			$this->getMessage()->addMessage('Salseman saved successfully.');
			if($this->getRequest()->getRequest('tab')=='customer')
			{
				$this->getMessage()->addMessage('Customer saved successfully.');
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$salsemanBlock = Ccc::getBlock('Salseman_Edit')->toHtml();
				$response = [
					'status' => 'success',
					'elements' =>[
							[
								'element' => '#indexContent',
								'content' => $salsemanBlock
							],

							[
								'element' => '#indexMessage',
								'content' => $messageBlock
							]

						]
					];
				$this->renderJson($response);
			}
			// $this->gridAction();
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
			$this->setPageTitle('Salseman Delete');
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			
			$salseman = Ccc::getModel('Salseman')->load($id);
			if(!$salseman)
			{
				throw new Exception("Record not found.", 1);
			}

			$salseman = $salseman->delete(); 
			if(!$salseman)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->getMessage()->addMessage('Salseman deleted successfully.');
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
				$query = "DELETE FROM `salseman`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `salseman` WHERE `salsemanId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('Salseman detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}