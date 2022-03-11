<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Page extends Controller_Admin_Action
{
	
	public function gridAction()
	{	
		$content = $this->getLayout()->getContent();
		$page = Ccc::getBlock('Page_Grid');
		$content->addChild($page);
		$this->renderLayout();
	}

	public function addAction()
	{
		$page = Ccc::getModel('Page');
		$page = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
		$content = $this->getLayout()->getContent();
		$content->addChild($page);
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
			$page = Ccc::getModel('Page')->load($id);
			if (!$page) 
      		{
      			throw new Exception("Unable to Load page.", 1);
      		}
     		$page = Ccc::getBlock('Page_Edit')->addData('page',$page);
			$content = $this->getLayout()->getContent();
			$content->addChild($page);
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
			$pageId = $request->getRequest('p',1);
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
			$this->redirect('grid',null,['p'=>$pageId],true);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['p'=>$pageId],true);
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$id=$this->getRequest()->getRequest('id');
			$pageId=$this->getRequest()->getRequest('p',1);
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
			echo $this->redirect('grid',null,['p'=>$pageId],true);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['p'=>$pageId],true);	
		}
	}
}