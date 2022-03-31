<?php 
Ccc::loadClass('Controller_Admin_Action');

class Controller_Product_Media extends Controller_Admin_Action
{
					
	public function saveAction()
	{
		try
		{

			$this->setPageTitle('Product Media Save');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('product'))
			{
				throw new Exception("First enter details of product.", 1);
			}
			$product = $request->getPost('product');
			$productId = $product['productId'];
			$product = Ccc::getModel('Product')->load($product['productId']);
			if (!$product) 
			{
				throw new Exception("No record found.", 1);
			}
			$mediaRow = Ccc::getModel('Product')->getMedia();
			if ($request->getPost('media')) 
			{
				$rows =  $request->getPost('media');
				if(array_key_exists('mediaId',$rows))
				{
					$ids = implode(',',array_values($rows['mediaId']));
					 
					$update = $this->getAdapter()->update("UPDATE `product_media` SET `gallery` = 2, `status` = 2 where `mediaId` IN ({$ids})");
					if(!$update)
					{
						throw new Exception("Unable to update product media.", 1);	
					}

					$update = $this->getAdapter()->update("UPDATE `product` SET `base` =null ,`thumb` = null, `small` = null where `productId` = ".$productId);
					if(!$update)
					{
						throw new Exception("Unable to update product.", 1);	
					}

					if(array_key_exists('remove',$rows))
					{
						foreach ($rows['remove'] as $row) 
						{
							$mediaRow = $mediaRow->load($row);
							$path = Ccc::getPath($mediaRow->getPath()).DIRECTORY_SEPARATOR.$mediaRow->media;
							unlink($path);
						}
						$removeId = implode(',',array_values($rows['remove']));
						$delete = $this->getAdapter()->delete("DELETE FROM  `product_media` WHERE `mediaId` IN ({$removeId})");
						if(!$delete)
						{
							throw new Exception("Unable to delete product media.", 1);	
						}
					}
					
					if(array_key_exists('base',$rows))
					{
						$product = Ccc::getModel('Product')->load($productId);
						$product->base = $rows['base'];
						$media = $product->getBase();
						if($media->media)
						{
							$update = $product->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
					}

					if(array_key_exists('thumb',$rows))
					{
						$product = Ccc::getModel('Product')->load($productId);
						$product->thumb = $rows['thumb'];
						$media = $product->getThumb();
						if($media->media)
						{
							$update = $product->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
					}

					if(array_key_exists('small',$rows))
					{
						$product = Ccc::getModel('Product')->load($productId);
						$product->small = $rows['small'];
						$media = $product->getSmall();
						if($media->media)
						{
							$update = $product->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
					}

					if(array_key_exists('gallery',$rows))
					{
						$ids = implode(',',array_values($rows['gallery']));
						$update = $this->getAdapter()->update("UPDATE `product_media` SET `gallery` = 1 WHERE `mediaId` IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to delete product media.", 1);	
						}

					}

					if(array_key_exists('status',$rows))
					{
						$ids = implode(',',array_values($rows['status']));
						$update = $this->getAdapter()->update("UPDATE `product_media` SET `status` = 1 WHERE `mediaId` IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to delete product media.", 1);	
						}

					}
					$this->getMessage()->addMessage('Product Media Updated Successfully.');
				}
			}
			
			else
			{
				
				if (empty($_FILES['media']['name']['fileName'])) 
				{
					throw new Exception("No image selected.", 1);				
				}
				$imagename = Ccc::getModel('Product_Media')->uploadImage($_FILES['media']);
				$mediaRow->setData(['productId'=>$productId]);
				$mediaRow->media = $imagename;
				$insert = $mediaRow->save();
				if(!$insert )
				{
					throw new Exception("Unable to insert image.", 1);
				}
				
				$this->getMessage()->addMessage('Product Media Uploaded Successfully.');
			}

			$this->redirect('grid','product');
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid','product');
		}
	}
}
		