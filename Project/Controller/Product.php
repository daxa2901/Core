<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Product extends Controller_Admin_Action
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
		$productBlock = Ccc::getBlock('Product_grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $productBlock
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
		$this->setPageTitle('Product Add');
		$product= Ccc::getModel('Product');
		Ccc::register('Product',$product);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$productBlock = Ccc::getBlock('Product_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $productBlock
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
			Ccc::register('Product',$product);

			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$productBlock = Ccc::getBlock('Product_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $productBlock
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
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function saveCategoryAction()
	{
		try 
		{
			$request = $this->getRequest();
			if (!$request->isPost()) 
			{
				throw new Exception("Invalid request.", 1);
			}
			if (!$request->getPost('product'))
			{
				throw new Exception("First enter details of product.", 1);
			}
			$product = $request->getPost('product');
			$product = Ccc::getModel('Product')->load($product['productId']);
			if (!$product) 
			{
				throw new Exception("No record found.", 1);
			}
			$product->saveCategories($request->getPost('category'));
			Ccc::register('Product',$product);
			$this->getMessage()->addMessage('product category saved successfully.');
			if($this->getRequest()->getRequest('tab')=='media')
				{
					$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
					$productBlock = Ccc::getBlock('Product_Edit')->toHtml();
					$response = [
						'status' => 'success',
						'elements' =>[
								[
									'element' => '#indexContent',
									'content' => $productBlock
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
			$product->getFinalPrice();
			$product = $product->save();
			if(!$product)
			{
				throw new Exception("System is unable to update.", 1);					
			}
			Ccc::register('Product',$product);
			$this->getMessage()->addMessage('product saved successfully.');
			if($this->getRequest()->getRequest('tab')=='category')
				{
					$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
					$productBlock = Ccc::getBlock('Product_Edit')->toHtml();
					$response = [
						'status' => 'success',
						'elements' =>[
								[
									'element' => '#indexContent',
									'content' => $productBlock
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

			$medias = $product->getMedia();
			if ($medias) 
			{
				foreach ($medias as $media) 
				{
					$path = Ccc::getPath($media->getPath()).DIRECTORY_SEPARATOR.$media->media;
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
				$query = "SELECT * FROM `product`";
				$products = Ccc::getModel('product')->fetchAll($query);
				foreach ($products as $key => $product) 
				{
					$media = $product->getMedia();
					foreach ($media as $key => $value) 
					{
						$path = Ccc::getPath($value->getPath()).DIRECTORY_SEPARATOR.$value->media;
						unlink($path);
					}
				}
				$query = "DELETE FROM `product`";
				
				$delete = $this->getAdapter()->delete($query);
				
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "SELECT * FROM `product` WHERE `productId` IN ({$ids})";
				$products = Ccc::getModel('product')->fetchAll($query);
				foreach ($products as $key => $product) 
				{
					$media = $product->getMedia();
					foreach ($media as $key => $value) 
					{
						$path = Ccc::getPath($value->getPath()).DIRECTORY_SEPARATOR.$value->media;
						unlink($path);
					}
				}
				$query = "DELETE FROM `product` WHERE `productId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('Product detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}
