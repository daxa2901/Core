<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Page extends Controller_Admin_Action
{
	public function indexAction()
	{
		$this->setPageTitle('Page ');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$pageBlock = Ccc::getBlock('Page_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $pageBlock
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
		$this->setPageTitle('Page Add');
		$page = Ccc::getModel('Page');
      	Ccc::register('page',$page);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
      	$pageBlock = Ccc::getBlock('Page_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $pageBlock
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
			$this->setPageTitle('Page Edit');
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) 
      		{
      			throw new Exception("Invalid Id.", 1);
      		}
			$page = Ccc::getModel('Page')->load($id);
			if (!$page) 
      		{
      			throw new Exception("Unable to Load page.", 1);
      		}
      		Ccc::register('page',$page);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
      		$pageBlock = Ccc::getBlock('Page_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $pageBlock
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
			$this->setPageTitle('Page Save');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('page')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			

			$row = $request->getPost('page');
			if (array_key_exists('pageId', $row))
			{
				if(!(int)$row['pageId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$page = Ccc::getModel('Page')->load($row['pageId']);
			}
			else
			{
				$page = Ccc::getModel('Page');
				$page->createdAt = date('Y-m-d H:i:s');
			}
			
			$page->setData($row);
			$page = $page->save();
			if(!$page)
			{	
				throw new Exception("System is unable to insert.", 1);
			}
			$this->getMessage()->addMessage('Page saved successfully.');
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
			$this->setPageTitle('Page Delete');
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$page = Ccc::getModel('Page')->load($id);
			if(!$page)
			{
				throw new Exception("Record not found.", 1);
			}

			$page = $page->delete(); 
			if(!$page)
			{
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->getMessage()->addMessage('Page Info Deleted Successfully.');
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
				$query = "DELETE FROM `page`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `page` WHERE `pageId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('page detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}