<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$productRow = Ccc::getBlock('Product_Grid');
		$content->addChild($productRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$product= Ccc::getModel('Product');
		$categoryPath = Ccc::getModel('Category')->getCategoryToPath();
     	$productRow = Ccc::getBlock('Product_Edit');

     	$productRow->setData(['product'=>$product]);
     	$productRow->addData('categoryProductPair',[]);
     	$productRow->addData('categoryPath',$categoryPath);
     	$content = $this->getLayout()->getContent();
		$content->addChild($productRow);
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$product= Ccc::getModel('Product')->load($id);
     		if(!$product)
     		{
     			throw new Exception("Unable to load product.", 1);    			
     		}

     		$categoryPath = Ccc::getModel('Category')->getCategoryToPath();
     		$productRow = Ccc::getBlock('Product_Edit');
     		$productRow->setData(['product'=>$product]);
     		$productRow->addData('categoryProductPair',$this->getAdapter()->fetchPair('SELECT entityId,categoryId FROM category_product WHERE productId = '.$this->getRequest()->getRequest('id')));
     		$productRow->addData('categoryPath',$categoryPath);
     		$content = $this->getLayout()->getContent();
			$content->addChild($productRow);
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

			$messages = $this->getMessage();
			$productRow = Ccc::getModel('Product');
			$request = $this->getRequest();
			$categoryProductRow = Ccc::getModel('Category_Product');
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('product')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$row = $request->getPost('product');

			if (array_key_exists('productId', $row)) 
			{
				if(!(int)$row['productId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				if (array_key_exists('category', $row)) 
				{
					$productCategory = $row['category'];
					unset($row['category']);
					 $categoryProductPair=$this->getAdapter()->fetchPair('SELECT entityId,categoryId FROM category_product WHERE productId = '.$row['productId']);
					 if (!$categoryProductPair) {
					 	$categoryProductPair = [];
					 }
					$categoryProductRow->productId = $row['productId'];
					foreach (array_diff($productCategory, $categoryProductPair) as $key => $value) 
					{

						$categoryProductRow->categoryId = $value;
						$insert = $categoryProductRow->save();
						if(!$insert)
						{
							throw new Exception('System is unable to insert category-product.', 1);
						}
					}

					$ids = implode(',',array_keys(array_diff($categoryProductPair, $productCategory)));
					if($ids)
					{
						$query = "DELETE FROM category_product WHERE entityId IN ({$ids})";
						$delete = $this->getAdapter()->delete($query);
						if(!$delete)
						{
							throw new Exception('System is unable to delete1.', 1);
						}
					}
				}
				else
				{
					$delete = $this->getAdapter()->delete("DELETE FROM  category_product WHERE productId = ({$row['productId']})"); 
					if(!$delete)
					{
						throw new Exception("System is unable to delete.", 1);							
					}
				}

				$productRow->setData($row);
				$productRow->updatedAt = date('Y-m-d H:i:s');
				$update = $productRow->save();
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			
				$messages->addMessage('Product Updated Successfully.');

			}
			else
			{
				if (array_key_exists('category', $row)) 
				{
					$productCategory = $row['category'];
					unset($row['category']);
					
				}
				$productRow->setData($row);
				$productRow->createdAt = date('Y-m-d H:i:s');
				$insert = $productRow->save();
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
				if($productCategory)
				{
					$categoryProductRow->productId = $insert;
					foreach ($productCategory as $key => $value) 
					{
						$categoryProductRow->categoryId = $value;
						$insert = $categoryProductRow->save();
						if(!$insert)
						{
							throw new Exception('System is unable to insert category-product.', 1);
						}
					}
				}

				$messages->addMessage('product Inserted Successfully.');
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
			$productRow = Ccc::getModel('Product');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id=(int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);							
			}

			$productRow= $productRow->load($id);

			if(!$productRow)
			{
				throw new Exception("Record not found.", 1);
			}

			$medias = Ccc::getModel('Product_Media')->fetchAll('SELECT * FROM product_media WHERE productId = '.$id);
			if ($medias) 
			{
				foreach ($medias as $media) 
				{
					$path =  $this->getLayout()->baseUrl($media->getResource()->getMediaPath()).'/'.$media->media;
					unlink($path);
				}
			}
			

			$delete = $productRow->delete(); 

			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}

			
			$messages->addMessage('Product Deleted Successfully.');
			$this->redirect('grid',null,null,true);
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,null,true));
		}
	}
}
