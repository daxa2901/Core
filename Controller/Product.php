<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		$product= Ccc::getModel('Product');
     	Ccc::getBlock('Product_Edit')->setData(['product'=>$product])->toHtml();
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
     		Ccc::getBlock('Product_Edit')->setData(['product'=>$product])->toHtml();
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,null,true));
			//echo $e->getMessage();
		}
	}

	public function saveAction()
	{
		try 
		{
			$productRow = Ccc::getModel('Product');
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

				$productRow->setData($row);
				$productRow->updatedAt = date('Y-m-d H:i:s');
				$update = $productRow->save();
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else
			{
				$productRow->setData($row);
				$productRow->createdAt = date('Y-m-d H:i:s');
				$insert = $productRow->save();
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
			}
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,null,true));
			
		} catch (Exception $e) {
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{
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

			$delete = $productRow->delete(); 

			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid',null,null,true));
		}
	}
}
