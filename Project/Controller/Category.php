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
	}

	public function addAction()
	{
		$category = Ccc::getModel('Category');
		$content = $this->getLayout()->getContent();
		$categoryRow = Ccc::getBlock('Category_Edit')->addData('category',$category);
		$content->addChild($categoryRow);
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
			$category = Ccc::getModel('Category')->load($id);
	 		if (!$category) 
	 		{
      			throw new Exception("Unable to Load Category.", 1);
      		}
      		$content = $this->getLayout()->getContent();
			$categoryRow = Ccc::getBlock('Category_Edit')->addData('category',$category);
			$content->addChild($categoryRow);
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
			$request=$this->getRequest();
			$categoryRow = Ccc::getModel('Category');
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}

			if (!$request->getPost('category')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
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
				$categoryPath=$categoryRow->fetchAll("SELECT `categoryId`,`categoryPath`,`updatedAt`,`parentId` FROM `Category` WHERE `categoryPath` LIKE '".$category->categoryPath.'/%'."' ORDER BY `categoryPath`");
		
				
				if($categoryRow->parentId == null)
				{	
					$categoryRow->parentId = null;
					$categoryRow->categoryPath = $id; 
				}
				else 	
				{
					$parent=$categoryRow->load($categoryRow->parentId);
					$categoryRow->categoryPath = $parent->categoryPath.'/'.$id;
				}
				$update = $categoryRow->save();
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
				
				$this->getMessage()->addMessage('Category Updated Successfully.');
			}
			else
			{
				$categoryRow->setData($row);
				$categoryRow->createdAt = date('Y-m-d H:i:s');

				if ($categoryRow->parentId == null) 
				{
					unset($categoryRow->parentId);
				}
				$category =$categoryRow->save();
				if(!$category)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$categoryRow->load($category->categoryId);
				if ($parent->parentId == NULL) 
				{
					$path = $category->categoryId;
				}
				else
				{
					$result=$categoryRow->load($parent->parentId);
					$path = $result->categoryPath.'/'.$category->categoryId;

				}
				$parent->categoryPath = $path;
				$update = $parent->save();
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}				
				$this->getMessage()->addMessage('Category Inserted Successfully.');
			}
		
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
			$id=(int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);							
			}

			$category = Ccc::getModel('Category')->load($id);
			if(!$category)
			{
				throw new Exception("Record not found.", 1);
			}
			$category = $category->delete(); 
			if(!$category)
			{
				throw new Exception("System is unable to  delete.", 1);
			}
			$this->getMessage()->addMessage('Category deleted successfully.');
			$this->redirect('grid',null,null,true);		
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,true);		
		}
	}
}
