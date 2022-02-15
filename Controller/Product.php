<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{
	public function gridAction()
	{
		global $adapter;
		$query = "SELECT * FROM Product";
		$product = $adapter-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('product',$product);
		$view->toHtml();
		//require_once('view/product/grid.php');
		
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/product/add.php')->toHtml();
		//require_once('view/product/add.php');
	}

	public function editAction()
	{
		global $adapter;
		$request = $this->getRequest();
		$pid=$request->getRequest('id');
     	$query = "SELECT * FROM Product WHERE productId=".$pid;
     	$product = $adapter-> fetchRow($query);
     	$view = $this->getView();
		$view->setTemplate('view/product/edit.php');
		$view->addData('product',$product);
		$view->toHtml();
		
		//require_once('view/product/edit.php');
	}

	public function saveAction()
	{
		try {
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('product')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}
			global $adapter;
			global $date;
			$row = $request->getPost('product');
			if (array_key_exists('id', $row)) 
			{
				if(!(int)$row['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$query = "UPDATE Product 
					SET name='".$row['name']."',
						price=".$row['price'].",
						quantity='".$row['quantity']."',
						updatedAt='".$date."',
						status='".$row['status']."' 
					Where productId='".$row['id']."'";	
				$update = $adapter->update($query);
				if(!$update)
				{
					throw new Exception("System is unable to update.", 1);					
				}
			}
			else{
				$query = "INSERT INTO Product(name,price,quantity,createdAt,status) 
				VALUES('".$row['name']."',
					   ".$row['price'].",
					   '".$row['quantity']."',
					   '".$date."',
					   '".$row['status']."')";
				$insert=$adapter->insert($query);
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
			global $adapter;
			$id=$request->getRequest('id');
			$query = "DELETE FROM Product WHERE productId = ".$id;
			$delete = $adapter->delete($query); 
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