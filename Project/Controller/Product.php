<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Product extends Controller_Admin_Action{
	public function gridAction()
	{
		$this->setPageTitle('Product Grid');
		$content = $this->getLayout()->getContent();
		$productRow = Ccc::getBlock('Product_Grid');
		$content->addChild($productRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Product Add');
		$product= Ccc::getModel('Product');
     	$productRow = Ccc::getBlock('Product_Edit');
     	$productRow->setData(['product'=>$product]);
     	$productRow->categoryProductPair =[];
     	$content = $this->getLayout()->getContent();
		$content->addChild($productRow);
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Product Edit');
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

     		$productRow = Ccc::getBlock('Product_Edit');
     		$productRow->setData(['product'=>$product]);
     		$query = "SELECT `entityId`,`categoryId` 
     						FROM `category_product` 
     				WHERE `productId` = {$id}";
     		$categoryProductPair = $this->getAdapter()->fetchPair($query);
     		$productRow->categoryProductPair = $categoryProductPair;
     		$content = $this->getLayout()->getContent();
			$content->addChild($productRow);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function saveAction()
	{
		try 
		{
			$this->setPageTitle('Product Save');
			$request = $this->getRequest();
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
				$product = Ccc::getModel('Product')->load($row['productId']);
				$product->updatedAt = date('Y-m-d H:i:s');
			}
			else
			{
				$product = Ccc::getModel('Product');
				$product->createdAt = date('Y-m-d H:i:s');
			}
			
			$product->setData($row);
			$product = $product->save();
			if(!$product)
			{
				throw new Exception("System is unable to update.", 1);					
			}

			$product->saveCategories($request->getPost('category'));
			$this->getMessage()->addMessage('product saved successfully.');
			$this->redirect('grid',null,['id'=>null]);
			
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$this->setPageTitle('Product Delete');
			$id=(int)$this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);							
			}

			$product = Ccc::getModel('Product')->load($id);

			if(!$product)
			{
				throw new Exception("Record not found.", 1);
			}

			$medias = Ccc::getModel('Product_Media')->fetchAll('SELECT * FROM `product_media` WHERE `productId` = '.$id);
			if ($medias) 
			{
				foreach ($medias as $media) 
				{
					$path =  $this->getLayout()->baseUrl($media->getResource()->getMediaPath()).'\\'.$media->media;
					unlink($path);
				}
			}
			$delete = $product->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			
			$this->getMessage()->addMessage('Product deleted successfully.');
			$this->redirect('grid',null,['id'=>null]);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,['id'=>null]));
		}
	}
}
