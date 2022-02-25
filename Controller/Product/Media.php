<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Product_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		$id = (int)$this->getRequest()->getRequest('id');
		if(!$id)
		{
			throw new Exception("Invalid Id.", 1);				
		}
		$medias = Ccc::getModel('Product_Media');
		$query = "SELECT * FROM media WHERE productId = ".$id;
		$medias = $medias->fetchAll($query);
		Ccc::getBlock('Product_Media_Grid')->setData(['media'=>$medias])->toHtml();
	}
	
	 function GetImageExtension($imagetype)
	 {
	   if(empty($imagetype['fileName'])) return false;
	   switch($imagetype['fileName'])
	   {
		   case 'image/bmp': return '.bmp';
		   case 'image/gif': return '.gif';
		   case 'image/jpeg': return '.jpg';
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
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			
			// if (!$request->getPost('media')) 
			// {
			// 	throw new Exception("Invalid Request.", 1);				
			// }

			$row = $request->getPost('media');
			$mediaRow = Ccc::getModel('Product_Media');
			// if (!array_key_exists('imageId', $row)) 
			// {
			// 	if(!(int)$row['imageId'])
			// 	{
			// 		throw new Exception("Invalid Request.", 1);
			// 	}
				if (empty($_FILES['media']['name']['fileName'])) 
				{

					throw new Exception("Select Image.", 1);				
				}

				$file_name=$_FILES["media"]["name"]['fileName'];
				$file_name = explode('.',$file_name);
				$temp_name=$_FILES["media"]["tmp_name"];
				$imagetype=$_FILES["media"]["type"];
				$ext= $this->GetImageExtension($imagetype);
				$imagename=$file_name['0'].'_'.date("dmYhms").$ext;
				$path =  Ccc::getBlock('Product_Grid')->baseUrl($mediaRow->getResource()->getMediaPath()).'/'.$imagename;
				
				$mediaRow->setData(['productId'=>$id]);
				$mediaRow->image = $imagename;
				$insert = $mediaRow->save();
				if(!$insert )
				{
					throw new Exception("Unable to insert image.", 1);
				}
				if(!move_uploaded_file($temp_name['fileName'], $path))
				{
					throw new Exception("Unable to Upload image.", 1);
				}
			 
				$this->redirect(Ccc::getBlock('Product_Media_Grid')->getUrl('grid'));
			}
			catch (Exception $e) 
			{
				// echo $e->getMessage();
				$this->redirect(Ccc::getBlock('Product_Media_Grid')->getUrl('grid',));
			}

	}

	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			 
			if(!$request->getRequest('media'))
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$mediaRow = Ccc::getModel('Product_Media');
			$productId = $request->getRequest('id');
			$rows =  $request->getPost('media');
			$count = count($rows['imageId']);
			for ($i=0; $i < $count; $i++) 
			{
				$base = 2;
				$thumb = 2;
				$small = 2;
				$gallery = 2;
				$status = 2;
				$imageId = $rows['imageId'][$i];
				echo $imageId;
				$gallery = 2 ;
				$status = 2;

				if(array_key_exists('remove',$rows)  && array_key_exists($imageId,$rows['remove']))
				{
					$mediaRow = $mediaRow->load($imageId);
					print_r($mediaRow);
					$path =  Ccc::getBlock('Product_Grid')->baseUrl($mediaRow->getResource()->getMediaPath()).'/'.$mediaRow->image;
					unlink($path);
					$delete = $mediaRow->delete();
					if(!$delete)
					{

						throw new Exception("System is unable to delete.", 1);
						
					}
					continue;
				}

				if(array_key_exists('base',$rows) && $rows['base'] == $imageId)
				{
					$base = 1;
					
				}

				if(array_key_exists('thumb',$rows) && $rows['thumb'] == $imageId)
				{

					$thumb = 1;
				}

				if(array_key_exists('small',$rows) && $rows['small'] == $imageId)
				{
					$small = 1;
				}

				if(array_key_exists('gallery',$rows) && array_key_exists($imageId,$rows['gallery']))
				{
					
					$gallery = 1;
					
				}

				if(array_key_exists('status',$rows) && array_key_exists($imageId,$rows['status']))
				{
					$status	 = 1;
					
				}

				$mediaRow->imageId = $imageId;
				$mediaRow->base = $base;
				$mediaRow->thumb = $thumb;
				$mediaRow->small = $small;
				$mediaRow->gallery = $gallery;
				$mediaRow->status = $status;
				print_r($mediaRow->getData());
				$update = $mediaRow->save();
				if(!$update)
				{
					throw new Exception("Unable to update product media.", 1);	
				}
			}
				$this->redirect(Ccc::getBlock('Product_Media_Grid')->getUrl('grid'));
		}
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Product_Media_Grid')->getUrl('grid'));
			//echo $e->getMessage();
		}

	}

}
		

		// $mediaRow = Ccc::getModel('Product_Media');
		// $request = $this->getRequest();
		// if(!$request->isPost())
		// {
		// 	throw new Exception("Invalid Request.", 1);				
		// }
		// if (!$request->getPost('media')) 
		// {
		// 	throw new Exception("Invalid Request.", 1);				
		// }

		// $row = $request->getPost('media');
		// $count = count($row['imageId']);
		// echo "<pre>";
		// for ($i=0; $i < $count; $i++) 
		// { 
		// 	 // print_r($row['imageId'][$i]);
		// 	 // print_r($row['base'][0]);
		// 	 if ($row['base'][0] == $row['imageId'][$i]) {
		// 	 	echo $row['imageId'][$i];
		// 	 	echo "<br>";
		// 		echo  $row['base'][0];
		// 	 }
		// 	if ($row['thumb'][0] == $row['imageId'][$i]) {
		// 	 	echo $row['imageId'][$i];
		// 	 	echo "<br>";
		// 		echo  $row['thumb'][0];
		// 	 }
		// 	if ($row['small'][0] == $row['imageId'][$i]) {
		// 	 	echo $row['imageId'][$i];
		// 	 	echo "<br>";
		// 		echo  $row['small'][0];
		// 	 }
		// 	 // print_r($row['thumb']);
		// }

		// print_r($row);
		// print_r($this->getRequest()->getRequest());
		// print_r(Ccc::getModel('Product_Media'));
		// print_r($this);
		// Ccc::getBlock('Product_Media_Grid')->toHtml();