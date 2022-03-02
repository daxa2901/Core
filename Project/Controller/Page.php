<?php Ccc::loadClass('Controller_Core_Action');?>

<?php
class Controller_Page extends Controller_Core_Action
{
	
	public function gridAction()
	{	
		$content = $this->getLayout()->getContent();
		$pageRow = Ccc::getBlock('Page_Grid');
		$content->addChild($pageRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$page = Ccc::getModel('Page');
		$pageRow = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
		$content = $this->getLayout()->getContent();
		$content->addChild($pageRow);
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
     		$pageRow = Ccc::getBlock('Page_Edit')->addData('page',$page);
			$content = $this->getLayout()->getContent();
			$content->addChild($pageRow);
			$this->renderLayout();

		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid',null,null,true));
			//echo $e->getMessage();
		}
		
	}
	
	public function saveAction()
	{
		try
		{

			$pageRow = Ccc::getModel('Page');
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
			print_r($row);
			if (array_key_exists('pageId', $row))
			{
				if(!(int)$row['pageId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$pageRow->setData($row);
				$update = $pageRow->save();
				if(!$update)
				{ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else
			{
				$pageRow->setData($row);
				$pageRow->createdAt = date('Y-m-d H:i:s');
				$insert = $pageRow->save();
				if(!$insert)
				{	
					throw new Exception("System is unable to insert.", 1);
				}
			}
			$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid',null,null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{	

			$pageRow = Ccc::getModel('Page');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id=$request->getRequest('id');
			$pageRow = $pageRow->load($id);
			if(!$pageRow)
			{

				throw new Exception("Record not found.", 1);
			}
			$delete = $pageRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid',null,null,true));	
		}
	}
}