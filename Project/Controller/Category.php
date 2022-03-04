<?php
Ccc::loadClass('Controller_Core_Action');
class Controller_Category extends Controller_Core_Action 
{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$categoryRow = Ccc::getBlock('Category_Grid');
		$content->addChild($categoryRow);
		$this->renderLayout();
		// Ccc::getBlock('Category_Grid')->toHtml();
	}

	public function addAction()
	{
		$category = Ccc::getModel('Category');
		$content = $this->getLayout()->getContent();
		$categoryRow = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
		$content->addChild($categoryRow);
		$this->renderLayout();
		
	}

	public function editAction()
	{
		try 
		{
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) {
      			throw new Exception("Invalid Id.", 1);
      		}
			$category = Ccc::getModel('Category')->load($id);
	 		if (!$category) 
	 		{
      			throw new Exception("Unable to Load Category.", 1);
      		}
      		$content = $this->getLayout()->getContent();
			$categoryRow = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
			$content->addChild($categoryRow);
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
			$request=$this->getRequest();
			$messages = $this->getMessage();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}

			if (!$request->getPost('category')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$categoryRow = Ccc::getModel('Category');
			$row = $request->getPost('category');
			$path = '';

			if (array_key_exists('categoryId', $row)) 
			{
				if(!(int)$row['categoryId'])
				{
					throw new Exception("Invalid Id.", 1);
				}

				$categoryRow->setData($row);
				$categoryRow->updatedAt = date('Y-m-d H:i:s');
				$id = $row['categoryId'];

				$category=$categoryRow->load($id);
				$categoryPath=$categoryRow->fetchAll("SELECT categoryId,categoryPath,updatedAt,parentId FROM Category WHERE categoryPath LIKE '".$category->categoryPath.'/%'."' ORDER BY categoryPath");
		
				
				if($categoryRow->parentId == null)
				{	
					$categoryRow->parentId = null;
					$categoryRow->categoryPath = $id; 
					$update = $categoryRow->save();
				}
				else 	
				{
					$parent=$categoryRow->load($categoryRow->parentId);
					$categoryRow->categoryPath = $parent->categoryPath.'/'.$id;
					$update = $categoryRow->save();
				}
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}	
		
				foreach ($categoryPath as $row) 
				{
					
					$parent=$categoryRow->load($row->parentId);
					$newPath = $parent->categoryPath.'/'.$row->categoryId;
					$row->categoryPath = $newPath;
					$row->updatedAt = date('Y-m-d H:i:s');
					$update = $row->save();
					if(!$update)
					{
						throw new Exception("System is unable to update.", 1);
					}	
				}
				
				$messages->addMessage('Category Updated Successfully.');
			}
			else
			{
				$categoryRow->setData($row);
				$categoryRow->createdAt = date('Y-m-d H:i:s');
				// print_r($categoryRow);

				if ($categoryRow->parentId == null) 
				{
					unset($categoryRow->parentId);

					$insert =$categoryRow->save();
				}
				else
				{
					$insert = $categoryRow->save();
				}
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$categoryRow->fetchRow("SELECT parentId,categoryPath,categoryId FROM Category WHERE categoryId=".$insert);
				if ($parent->parentId == NULL) 
				{
					$path = $insert;
				}
				else
				{
					$result=$categoryRow->load($parent->parentId);
					$path = $result->categoryPath.'/'.$insert;

				}
				$parent->categoryPath = $path;
				$update = $parent->save();
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}				
				$messages->addMessage('Category Inserted Successfully.');
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
			$categoryRow = Ccc::getModel('Category');
			$request=$this->getRequest();
			if (!($request->getRequest('id'))) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id=(int) $request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);							
			}

			$categoryRow= $categoryRow->load($id);
			if(!$categoryRow)
			{
				throw new Exception("Record not found.", 1);
			}
			$delete = $categoryRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.", 1);
			}
			$messages->addMessage('Category Deleted Successfully.');
			$this->redirect('grid',null,null,true);		
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);		
		}
	}
}
