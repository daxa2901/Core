<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Category_Media extends Controller_Core_Action
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
			$product = Ccc::getModel('Category')->load($id);

			if (!$product) 
			{
				throw new Exception("Unable to load Category.", 1);
			}
			$medias = Ccc::getModel('Category_Media');
			$query = "SELECT cm.*,c.base,c.thumb,c.small FROM category_media cm JOIN category c ON cm.categoryId = c.categoryId WHERE c.categoryId = ".$id;
			$medias = $medias->fetchAll($query);
			$categoryMediaRow =Ccc::getBlock('Category_Media_Grid')->setData(['media'=>$medias]);
		 	$content = $this->getLayout()->getContent();
			$content->addChild($categoryMediaRow);
			$this->renderLayout();

		}
		catch(Excaption $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	 function GetImageExtension($imagetype)
	 {
	   if(empty($imagetype['fileName'])) return false;
	   switch($imagetype['fileName'])
	   {
		   case 'image/jpg': return '.jpg';
		   case 'image/jpeg': return '.jpeg';
		   case 'image/png': return '.png';
		   default: return false;
	   }
	 }
						
	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$categoryId = (int) $request->getRequest('id');
			if(!$categoryId)
			{
				throw new Exception("Invalid Id.", 1);				
			}

			$mediaRow = Ccc::getModel('Category_Media');
			$categoryRow = Ccc::getModel('Category');
			if ($request->getPost('media')) 
			{
			
				$rows =  $request->getPost('media');
				if(array_key_exists('mediaId',$rows))
				{
					$ids = implode(',',array_values($rows['mediaId']));
					 
					$update = $this->getAdapter()->update("UPDATE category_media SET gallery = 2, status = 2 where mediaId IN ({$ids})");
					if(!$update)
					{
						throw new Exception("Unable to update Category media.", 1);	
					}

					$update = $this->getAdapter()->update("UPDATE category SET base =null ,thumb = null, small = null where categoryId = ".$categoryId);
					if(!$update)
					{
						throw new Exception("Unable to update Category media.", 1);	
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
						$delete = $this->getAdapter()->delete("DELETE FROM  category_media WHERE mediaId IN ({$removeId})");
						if(!$delete)
						{
							throw new Exception("Unable to delete Category media.", 1);	
						}


					}
					
					if(array_key_exists('base',$rows))
					{
						$media = Ccc::getModel('Category_Media')->load($rows['base']);
						if($media)
						{
							$categoryRow->categoryId = $categoryId;
							$categoryRow->base = $rows['base'];
							$update = $categoryRow->save();
							if(!$update)
							{
								throw new Exception("Unable to update product.", 1);	
							}
						}
											
					}

					if(array_key_exists('thumb',$rows))
					{
						$media = Ccc::getModel('Category_Media')->load($rows['thumb']);
						if($media)
						{
							$categoryRow->categoryId = $categoryId;
							$categoryRow->thumb = $rows['thumb'];
							$update = $categoryRow->save();
							if(!$update)
							{
								throw new Exception("Unable to update Category.", 1);	
							}
						}
											
					}

					if(array_key_exists('small',$rows))
					{
						$media = Ccc::getModel('Category_Media')->load($rows['small']);
						if($media)
						{
							$categoryRow->categoryId = $categoryId;
							$categoryRow->small = $rows['small'];
							$update = $categoryRow->save();
							if(!$update)
							{
								throw new Exception("Unable to update Category.", 1);	
							}
						}
											
					}

					if(array_key_exists('gallery',$rows))
					{
						$ids = implode(',',array_values($rows['gallery']));
						$update = $this->getAdapter()->update("UPDATE category_media SET gallery = 1 WHERE mediaId IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to delete Category media.", 1);	
						}

					}

					if(array_key_exists('status',$rows))
					{
						$ids = implode(',',array_values($rows['status']));
						$update = $this->getAdapter()->update("UPDATE category_media SET status = 1 WHERE mediaId IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to delete Category media.", 1);	
						}

					}
				}
			}
			
			else
			{
				
				if (empty($_FILES['media']['name']['fileName'])) 
				{

					throw new Exception("Select Image.", 1);				
				}
				// $media = Ccc::getModel('Category_Media')->uploadImage($_FILES['media']['name']['fileName']);
				$file_name=$_FILES["media"]["name"]['fileName'];
				$file_name = explode('.',$file_name);
				$temp_name=$_FILES["media"]["tmp_name"];
				$imagetype=$_FILES["media"]["type"];
				$ext= $this->GetImageExtension($imagetype);
				if (!$ext) {
					throw new Exception("Image must of type JPG, JPEG or  PNG", 1);
				}
				$imagename=$file_name['0'].'_'.date("dmYhms").$ext;
				$path =  Ccc::getBlock('Product_Grid')->baseUrl($mediaRow->getResource()->getMediaPath()).'/'.$imagename;
				
				$mediaRow->setData(['categoryId'=>$categoryId]);
				$mediaRow->media = $imagename;
				$insert = $mediaRow->save();
				print_r($insert);
				echo $path;
				if(!$insert )
				{
					throw new Exception("Unable to insert image.", 1);
				}
				if(!move_uploaded_file($temp_name['fileName'], $path))
				{	
					echo "22";
					exit;
					throw new Exception("Unable to Upload image.", 1);
				}
			}

			$this->redirect(Ccc::getBlock('Category_Media_Grid')->getUrl('grid'));
			
		}
				catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Category_Media_Grid')->getUrl('grid'));
			// echo $e->getMessage();
		}

	}

}
	