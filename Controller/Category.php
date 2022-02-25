<?php
Ccc::loadClass('Controller_Core_Action');
class Controller_Category extends Controller_Core_Action 
{

	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Category_Add')->toHtml();
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
      			throw new Exception("Unable to Load Admin.", 1);
      		}
     		Ccc::getBlock('Category_Edit')->setData(['category'=>$category])->toHtml();
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid',null,null,true));
			//echo $e->getMessage();
		}
	}

	public function saveAction()
	{
		try 
		{	
			$request=$this->getRequest();

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
					throw new Exception("Invalid Request.", 1);
				}

				$categoryRow->setData($row);
				$categoryRow->updatedAt = date('Y-m-d H:i:s');
				$id = $row['categoryId'];

				$category=$categoryRow->load($id);
				$categoryPath=$categoryRow->fetchAll("SELECT * FROM Category WHERE categoryPath LIKE '".$category->categoryPath.'/%'."' ORDER BY categoryPath");
		
				if($row['parentId'] == null)
				{	
					$row['parentId'] = null;
					$row['categoryPath'] = $id; 
					$categoryRow->update($row,$id);
				}
				else 	
				{
					$parent=$categoryRow->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
					$row['categoryPath'] = $parent['categoryPath'].'/'.$id;
					$categoryRow->update($row,$id);
				}
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}	
		
				foreach ($categoryPath as $row) 
				{
					$parent=$this->getAdapter()->fetchRow("SELECT * FROM Category WHERE categoryId= ".$row['parentId']);
					$newPath = $parent['categoryPath'].'/'.$row['categoryId'];

					$query = "UPDATE Category
						SET categoryPath = '".$newPath."',
							updatedAt = '".date('Y-m-d H:i:s')."'
							WHERE categoryId = ".$row['categoryId'];
					$update = $this->getAdapter()->update($query);
					if(!$update)
					{
						throw new Exception("System is unable to update.", 1);
					}	
				}
				$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid',null,null,true));
				
			}
			else
			{
				$row['createdAt'] = date('Y-m-d H:i:s');
				if ($row['parentId'] == null) 
				{
					unset($row['parentId']);
					$insert =$categoryRow->insert($row);
				}
				else
				{
					$insert = $categoryRow->insert($row);
				}
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);			
				}

				$parent=$this->getAdapter()->fetchOne("SELECT parentId FROM Category WHERE categoryId=".$insert);
				if ($parent == NULL) 
				{
					$path = $insert;
				}
				else
				{
					$result=$this->getAdapter()->fetchRow("SELECT * FROM Category WHERE categoryId= ".$parent);
					$path = $result['categoryPath'].'/'.$insert;

				}
				$data['categoryPath'] = $path;
				$update = $categoryRow->update($data,$insert);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);
				}				
			}
		$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid',null,null,true));
		
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid',null,null,true));	
		}
	}
	
	public function deleteAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('Category');
			$request=$this->getRequest();
			if (!($request->getRequest('id'))) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id=$request->getRequest('id');
			$delete = $categoryRow->delete(['categoryId'=>$id]); 
			if(!$delete)
			{
				throw new Exception("System is unable to  delete.", 1);
			}
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid',null,null,true));		
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid',null,null,true));		
		}
	}
}
