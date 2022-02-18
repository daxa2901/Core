<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
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
			$productTable = Ccc::getModel('Product');
			$query = "SELECT * FROM Product WHERE productId=".$id;
     		$product = $productTable->fetchRow($query);
     		if(!$product)
     		{
     			throw new Exception("Unable to load product.", 1);    			
     		}
     		Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('product','grid',null,true));
			//echo $e->getMessage();
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
			if (!$request->getPost('product')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$productTable = Ccc::getModel('Product');
			$row = $request->getPost('product');

			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$row['updatedAt'] = date('Y-m-d H:i:s');
				$id = $row['id'];
				unset($row['id']);
				$update = $productTable->update($row,$id);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
				$row['createdAt'] = date('Y-m-d H:i:s');
				$insert = $productTable->insert($row);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
			}
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('product','grid',null,true));
			
		} catch (Exception $e) {
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('product','grid',null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$productTable = Ccc::getModel('Product');
			$id=(int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);							
			}
			$delete = $productTable->delete($id); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('product','grid',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('product','grid',null,true));
		}
	}
}
