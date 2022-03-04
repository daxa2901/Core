<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Product_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		try
		{
			$id = (int)$this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$product = Ccc::getModel('Product')->load($id);

			if (!$product) 
			{
				throw new Exception("Unable to load Product.", 1);
			}
			$medias = Ccc::getModel('Product_Media');
			$query = "SELECT pm.*,p.base,p.thumb,p.small FROM product_media pm JOIN product p ON pm.productId = p.productId WHERE p.productId = ".$id;
			$medias = $medias->fetchAll($query);
			$productMediaRow =Ccc::getBlock('Product_Media_Grid')->setData(['media'=>$medias]);
			$content = $this->getLayout()->getContent();
			$content->addChild($productMediaRow);
			$this->renderLayout();

		}
		catch(Exception $e)
		{
			$messages = $this->getMessage();
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid','Product',null,true);
		}
		
	}
						
	public function saveAction()
	{
		try
		{
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$productId = (int) $request->getRequest('id');
			if(!$productId)
			{
				throw new Exception("Invalid Id.", 1);				
			}

			$mediaRow = Ccc::getModel('Product_Media');
			$productRow = Ccc::getModel('Product');
			if ($request->getPost('media')) 
			{
			
				$rows =  $request->getPost('media');
				if(array_key_exists('mediaId',$rows))
				{
					$ids = implode(',',array_values($rows['mediaId']));
					 
					$update = $this->getAdapter()->update("UPDATE product_media SET gallery = 2, status = 2 where mediaId IN ({$ids})");
					if(!$update)
					{
						throw new Exception("Unable to update product media.", 1);	
					}

					$update = $this->getAdapter()->update("UPDATE product SET base =null ,thumb = null, small = null where productId = ".$productId);
					if(!$update)
					{
						throw new Exception("Unable to update product.", 1);	
					}

					if(array_key_exists('remove',$rows))
					{
						foreach ($rows['remove'] as $row) 
						{
							$mediaRow = $mediaRow->load($row);
							$path =  Ccc::getBlock('Product_Grid')->baseUrl($mediaRow->getResource()->getMediaPath()).'/'.$mediaRow->media;
							unlink($path);
						}
						$removeId = implode(',',array_values($rows['remove']));
						$delete = $this->getAdapter()->delete("DELETE FROM  product_media WHERE mediaId IN ({$removeId})");
						if(!$delete)
						{
							throw new Exception("Unable to delete product media.", 1);	
						}


					}
					
					if(array_key_exists('base',$rows))
					{
						$media = Ccc::getModel('Product_Media')->load($rows['base']);
						if($media)
						{
							$productRow->productId = $productId;
							$productRow->base = $rows['base'];
							$update = $productRow->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
											
					}

					if(array_key_exists('thumb',$rows))
					{
						$media = Ccc::getModel('Product_Media')->load($rows['thumb']);
						if($media)
						{
							$productRow->productId = $productId;
							$productRow->thumb = $rows['thumb'];
							$update = $productRow->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
											
					}

					if(array_key_exists('small',$rows))
					{
						$media = Ccc::getModel('Product_Media')->load($rows['small']);
						if($media)
						{
							$productRow->productId = $productId;
							$productRow->small = $rows['small'];
							$update = $productRow->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
											
					}

					if(array_key_exists('gallery',$rows))
					{
						$ids = implode(',',array_values($rows['gallery']));
						$update = $this->getAdapter()->update("UPDATE product_media SET gallery = 1 WHERE mediaId IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to delete product media.", 1);	
						}

					}

					if(array_key_exists('status',$rows))
					{
						$ids = implode(',',array_values($rows['status']));
						$update = $this->getAdapter()->update("UPDATE product_media SET status = 1 WHERE mediaId IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to delete product media.", 1);	
						}

					}
					$messages->addMessage('Product Media Updated Successfully.');
				}
			}
			
			else
			{
				
				if (empty($_FILES['media']['name']['fileName'])) 
				{

					throw new Exception("Select Image.", 1);				
				}
				$file_name = pathinfo($_FILES['media']['name']['fileName'],PATHINFO_FILENAME);
				$temp_name=$_FILES["media"]["tmp_name"];
				$ext = pathinfo($_FILES['media']['name']['fileName'],PATHINFO_EXTENSION);
				if($ext !='png' && $ext != 'jpg' && $ext = 'jpeg')
				{
					throw new Exception("Image must of type JPG, JPEG or  PNG", 1);
				}
				
				$imagename=$file_name.'_'.date("dmYhms").'.'.$ext;
				$path =  Ccc::getBlock('Product_Grid')->baseUrl($mediaRow->getResource()->getMediaPath()).'/'.$imagename;
				$media = Ccc::getModel('Product_Media')->uploadImage($temp_name['fileName'],$path);
				
				$mediaRow->setData(['productId'=>$productId]);
				$mediaRow->media = $imagename;
				$insert = $mediaRow->save();
				if(!$insert )
				{
					throw new Exception("Unable to insert image.", 1);
				}
				
				$messages->addMessage('Product Media Uploaded Successfully.');
			}

			$this->redirect('grid');
			
		}
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid');
		}

	}

}
		
// 	$count = count($rows['mediaId']);
		// 	for ($i=0; $i < $count; $i++) 
		// 	{
		// 		$base = 2;
		// 		$thumb = 2;
		// 		$small = 2;
		// 		$gallery = 2;
		// 		$status = 2;
		// 		$mediaId = $rows['mediaId'][$i];
		// 		echo $mediaId;
		// 		$gallery = 2 ;
		// 		$status = 2;

		// 		if(array_key_exists('remove',$rows)  && array_key_exists($mediaId,$rows['remove']))
		// 		{
		// 			$mediaRow = $mediaRow->load($mediaId);
		// 			print_r($mediaRow);
		// 			$path =  Ccc::getBlock('Product_Grid')->baseUrl($mediaRow->getResource()->getMediaPath()).'/'.$mediaRow->image;
		// 			unlink($path);
		// 			$delete = $mediaRow->delete();
		// 			if(!$delete)
		// 			{

		// 				throw new Exception("System is unable to delete.", 1);
						
		// 			}
		// 			continue;
		// 		}

		// 		if(array_key_exists('base',$rows) && $rows['base'] == $mediaId)
		// 		{
		// 			$base = 1;
					
		// 		}

		// 		if(array_key_exists('thumb',$rows) && $rows['thumb'] == $mediaId)
		// 		{

		// 			$thumb = 1;
		// 		}

		// 		if(array_key_exists('small',$rows) && $rows['small'] == $mediaId)
		// 		{
		// 			$small = 1;
		// 		}

		// 		if(array_key_exists('gallery',$rows) && array_key_exists($mediaId,$rows['gallery']))
		// 		{
					
		// 			$gallery = 1;
					
		// 		}

		// 		if(array_key_exists('status',$rows) && array_key_exists($mediaId,$rows['status']))
		// 		{
		// 			$status	 = 1;
					
		// 		}

		// 		$mediaRow->mediaId = $mediaId;
		// 		$mediaRow->base = $base;
		// 		$mediaRow->thumb = $thumb;
		// 		$mediaRow->small = $small;
		// 		$mediaRow->gallery = $gallery;
		// 		$mediaRow->status = $status;
		// 		print_r($mediaRow->getData());
		// 		$update = $mediaRow->save();
		// 		if(!$update)
		// 		{
		// 			throw new Exception("Unable to update product media.", 1);	
		// 		}
		// 	}
		// }


