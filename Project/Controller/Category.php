<?php
Ccc::loadClass('Controller_Admin_Action');
class Controller_Category extends Controller_Admin_Action 
{

	public function indexAction()
	{
		$this->setPageTitle('Product Page');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{	
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$categoryBlock = Ccc::getBlock('Category_grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $categoryBlock
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
		$this->setPageTitle('Category Add');
		$category = Ccc::getModel('Category');
		Ccc::register('category',$category);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$categoryBlock = Ccc::getBlock('Category_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $categoryBlock
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
			$this->setPageTitle('Category Edit');
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
			Ccc::register('category',$category);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$categoryBlock = Ccc::getBlock('Category_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $categoryBlock
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
			$this->setPageTitle('Category Save');
			$request=$this->getRequest();
			$categoryRow = Ccc::getModel('Category');
			if(!$request->isPost() || !$request->getPost('category')) 
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
				$category = $categoryRow->save();
				if(!$category)
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
			Ccc::register('category',$category);
			if($this->getRequest()->getRequest('tab')=='media')
			{
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$categoryBlock = Ccc::getBlock('Category_Edit')->toHtml();
				$response = [
					'status' => 'success',
					'elements' =>[
							[
								'element' => '#indexContent',
								'content' => $categoryBlock
							],

							[
								'element' => '#indexMessage',
								'content' => $messageBlock
							]

						]
					];
				$this->renderJson($response);
			}
			else
			{
				$this->gridAction();
			}
		
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
			$this->setPageTitle('Category Delete');
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
			$media = $category->getMedia();
			foreach ($media as $key => $value) 
			{
				$path = Ccc::getPath($value->getPath()).DIRECTORY_SEPARATOR.$value->media;
				unlink($path);
			}
			$category = $category->delete(); 
			if(!$category)
			{
				throw new Exception("System is unable to  delete.", 1);
			}
			$this->getMessage()->addMessage('Category deleted successfully.');
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
				$query = "SELECT * FROM `category`";
				$categories = Ccc::getModel('Category')->fetchAll($query);
				foreach ($categories as $key => $category) 
				{
					$media = $category->getMedia();
					foreach ($media as $key => $value) 
					{
						$path = Ccc::getPath($value->getPath()).DIRECTORY_SEPARATOR.$value->media;
						unlink($path);
					}
				}
				$query = "DELETE FROM `category`";
				
				$delete = $this->getAdapter()->delete($query);
				
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "SELECT * FROM `category` WHERE `categoryId` IN ({$ids})";
				$categories = Ccc::getModel('Category')->fetchAll($query);
				foreach ($categories as $key => $category) 
				{
					$media = $category->getMedia();
					foreach ($media as $key => $value) 
					{
						$path = Ccc::getPath($value->getPath()).DIRECTORY_SEPARATOR.$value->media;
						unlink($path);
					}
				}
				$query = "DELETE FROM `category` WHERE `categoryId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('Category detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}
