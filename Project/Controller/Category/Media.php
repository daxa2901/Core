<?php 
Ccc::loadClass('Controller_Admin_Action');

class Controller_Category_Media extends Controller_Admin_Action
{
						
	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Category Media Save');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request1.", 1);				
			}
			$categoryId = (int) $request->getRequest('id');
			if(!$categoryId)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$category = Ccc::getModel('category')->load($categoryId);
			if (!$category) 
			{
				throw new Exception("No record found.", 1);
			}

			$categoryRow = Ccc::getModel('Category');
			$mediaRow = $categoryRow->getMedia();
			if ($request->getPost('media')) 
			{
				$rows =  $request->getPost('media');
				if(array_key_exists('mediaId',$rows))
				{
					$ids = implode(',',array_values($rows['mediaId']));
					 
					$update = $this->getAdapter()->update("UPDATE `category_media` SET `gallery` = 2, `status` = 2 where `mediaId` IN ({$ids})");
					if(!$update)
					{
						throw new Exception("Unable to update Category media.", 1);	
					}

					$update = $this->getAdapter()->update("UPDATE `category` SET `base` =null ,`thumb` = null, `small` = null where `categoryId` = ".$categoryId);
					if(!$update)
					{
						throw new Exception("Unable to update Category.", 1);	
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
						$delete = $this->getAdapter()->delete("DELETE FROM  `category_media` WHERE `mediaId` IN ({$removeId})");
						if(!$delete)
						{
							throw new Exception("Unable to delete Category media.", 1);	
						}
					}
					
					if(array_key_exists('base',$rows))
					{
						$category = Ccc::getModel('Category')->load($categoryId);
						$category->base = $rows['base'];
						$media = $category->getBase();
						if($media->media)
						{
							$update = $category->save();
							if(!$update)
							{
								throw new Exception("Unable to update category.", 1);	
							}
						}
						
					}

					if(array_key_exists('thumb',$rows))
					{
						$category = Ccc::getModel('Category')->load($categoryId);
						$category->thumb = $rows['thumb'];
						$media = $category->getThumb();
						if($media->media)
						{
							$update = $category->save();
							if(!$update)
							{
								throw new Exception("Unable to update category.", 1);	
							}
						}
					}

					if(array_key_exists('small',$rows))
					{
						$category = Ccc::getModel('Category')->load($categoryId);
						$category->small = $rows['small'];
						$media = $category->getSmall();
						if($media->media)
						{
							$update = $category->save();
							if(!$update)
							{
								throw new Exception("Unable to update category.", 1);	
							}
						}
					}

					if(array_key_exists('gallery',$rows))
					{
						$ids = implode(',',array_values($rows['gallery']));
						$update = $this->getAdapter()->update("UPDATE `category_media` SET `gallery` = 1 WHERE `mediaId` IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to update Category media.", 1);	
						}
					}

					if(array_key_exists('status',$rows))
					{
						$ids = implode(',',array_values($rows['status']));
						$update = $this->getAdapter()->update("UPDATE `category_media` SET `status` = 1 WHERE `mediaId` IN ({$ids})");
						if(!$update)
						{
							throw new Exception("Unable to update Category media.", 1);	
						}
					}
					$this->getMessage()->addMessage('Cataegory Media Updated Successfully.');
				}
			}
			
			else
			{
				if (empty($_FILES['file']['name'])) 
				
				{
					throw new Exception("No image selected.", 1);				
				}

				$imagename = Ccc::getModel('Category_Media')->uploadImage($_FILES['file']);
				$mediaRow->setData(['categoryId'=>$categoryId]);
				$mediaRow->media = $imagename;
				$insert = $mediaRow->save();
				if(!$insert )
				{
					throw new Exception("Unable to insert Image.", 1);
				}
				
				$this->getMessage()->addMessage('Category Media Uploaded Successfully.');
			}
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$categoryBlock = Ccc::getBlock('Category_Grid')->toHtml();
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
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$categoryBlock = Ccc::getBlock('Category_Grid')->toHtml();
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
	}
}
	