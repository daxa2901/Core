<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		$customerTable = Ccc::getModel('Customer'); 
		$query = "SELECT 
					* 
				FROM Customer";
		$query2 = "SELECT a.address 
				FROM Customer c 
					JOIN  
				address a ON c.customerId = a.customerId";
		$customer = $customerTable-> fetchAll($query);
		$address = $customerTable-> fetchAll($query2);
		$view = $this->getView();
		$view->setTemplate('view/customer/grid.php');
		$view->addData('customer',$customer);
		$view->addData('address',$address);
		$view->toHtml();
	}

	public function addAction()
	{
		$view = $this->getView();	
		$view->setTemplate('view/customer/add.php')->toHtml();
	}

	public function editAction()
	{
		$customerTable = Ccc::getModel('Customer');
		$request=$this->getRequest();
    $pid=$request->getRequest('id');
 		$query = "SELECT * FROM Customer  
			   WHERE customerId=".$pid;
		$customer = $customerTable-> fetchRow($query);
		$query2 = "SELECT 
                  a.* 
                FROM 
              Address a 
                JOIN 
              Customer c ON a.customerId = c.customerId WHERE a.customerId =".$pid;  
		$address = $customerTable-> fetchRow($query2);
		$view = $this->getView();
		$view->setTemplate('view/customer/edit.php');
		$view->addData('customer',$customer);
		$view->addData('address',$address);
		$view->toHtml();
		
		//require_once('view/customer/edit.php');
	}
	protected function saveCustomer()
	{
		$request=$this->getRequest();
    if(!$request->isPost())
		{
			throw new Exception("Invalid Request.", 1);				
		} 	
		if (!$request->getPost('customer')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
					
		$customerTable = Ccc::getModel('Customer');
		global $date;
		$row = $request->getPost('customer');

		if (array_key_exists('customerId', $row)) 
		{
			if(!(int)$row['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row["customerId"];
			$row['updatedDate'] = $date;
			unset($row['customerId']);
			$update = $customerTable->update($row,['customerId'=>$customerId]);
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else{
			$row['createdDate'] = $date;
			$customerId = $customerTable->insert($row);
			if(!$customerId)
			{	
					throw new Exception("System is unable to insert.", 1);
			}
			
		}

		return $customerId;
	
	}

	protected function saveAddress($customerId)
	{
		$request = $this->getRequest();
		if(!$request->isPost())
		{
			throw new Exception("Invalid Request.", 1);				
		}
		if (!$request->getPost('address')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}

		$customerTable = Ccc::getModel('Customer');
		$row = $request->getPost('address');
	
		$billing=2;	
		$shipping=2;

		if (array_key_exists('billing', $row) && $row['billing'] == 1) 
		{
				$billing = 1;			
		}
		if (array_key_exists('shipping', $row) && $row['shipping'] == 1) 
		{
				$shipping = 1;
		}

		$query = "SELECT * FROM address WHERE customerId = $customerId";
		$addressData = $customerTable->fetchRow($query);
		$customerTable->setTable('address');
		$row['billing'] = $billing;
		$row['shipping'] = $shipping;
			
		if($addressData)
		{
			$update = $customerTable->update($row,$customerId);
			if(!$update)
			{ 

				throw new Exception("System is unable to update.", 1);
			}
		}
		else
		{
			$row['customerId'] = $customerId;
			$result = $customerTable->insert($row);
			if (!$result) 
			{
				throw new Exception("System is unable to insert", 1);
			}
		}	
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->redirect('index.php?c=customer&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=customer&a=grid');
		}
	}

	public function deleteAction()
	{
		try {
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$customerTable = Ccc::getModel('Customer');
			$id=$request->getRequest('id');
			$delete = $customerTable->delete($id); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=customer&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('index.php?c=customer&a=grid');	
			//echo $e->getMessage();
		}
	}

	public function errorAction()
	{
		echo "error";
	}
}
?>