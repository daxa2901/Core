<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		$productTable = Ccc::getModel('Product');
		$query = "SELECT * FROM Product";
		$product = $productTable-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('product',$product);
		$view->toHtml();		
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/product/add.php')->toHtml();
	}

	public function editAction()
	{
		global $adapter;
		$productTable = Ccc::getModel('Product');
		$request = $this->getRequest();
		$pid=$request->getRequest('id');
     	$query = "SELECT * FROM Product WHERE productId=".$pid;
     	$product = $productTable->fetchRow($query);
     	$view = $this->getView();
		$view->setTemplate('view/product/edit.php');
		$view->addData('product',$product);
		$view->toHtml();
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
			global $date;
			$productTable = Ccc::getModel('Product');
			$row = $request->getPost('product');

			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$row['updatedAt'] = $date;
				$id = $row['id'];
				unset($row['id']);
				$update = $productTable->update($row,$id);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
				$row['createdAt'] = $date;
				$insert = $productTable->insert($row);
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);					
				}
			}
			$this->redirect("index.php?c=product&a=grid");
			
		} catch (Exception $e) {
			$this->redirect("index.php?c=product&a=grid");
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
			$id=$request->getRequest('id');
			$delete = $productTable->delete($id); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
			
			$this->redirect("index.php?c=product&a=grid");
		} catch (Exception $e) 
		{
			$this->redirect("index.php?c=product&a=grid");
		}
	}

	public function errorAction()
	{
		echo "error";
	}
}

?>