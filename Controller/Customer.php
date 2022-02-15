<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		global $adapter; 
		$query = "SELECT 
					* 
				FROM Customer";
		$query2 = "SELECT a.address 
				FROM Customer c 
					JOIN  
				address a ON c.customerId = a.customerId";
		$customer = $adapter-> fetchAll($query);
		$address = $adapter-> fetchAll($query2);
		$view = $this->getView();
		
		$view->setTemplate('view/customer/grid.php');
		$view->addData('customer',$customer);
		$view->addData('address',$address);
		$view->toHtml();
		//require_once('view/customer/grid.php');
	}

	public function addAction()
	{
		$view = $this->getView();
		
		$view->setTemplate('view/customer/add.php')->toHtml();
		
		//require_once('view/customer/add.php');
	}

	public function editAction()
	{
		global $adapter;
		$request=$this->getRequest();
    $pid=$request->getRequest('id');
 		$query = "SELECT * FROM Customer  
			   WHERE customerId=".$pid;
		$customer = $adapter-> fetchRow($query);
		$query2 = "SELECT 
                  a.* 
                FROM 
              Address a 
                JOIN 
              Customer c ON a.customerId = c.customerId WHERE a.customerId =".$pid;  
		$address = $adapter-> fetchRow($query2);
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
					
		global $adapter;
		global $date;
		$row = $request->getPost('customer');

		if (array_key_exists('customerId', $row)) 
		{
			if(!(int)$row['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row["customerId"];
			$query = "UPDATE Customer 
				SET firstName='".$row['firstName']."',
					lastName='".$row['lastName']."',
					email='".$row['email']."',
					mobile='".$row['mobile']."',
					status='".$row['status']."',
					updatedDate='".$date."' 
				WHERE customerId='".$customerId."'";

			$update = $adapter->update($query);
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else{
			$query = "INSERT INTO Customer(firstName,lastName,email,mobile,status,createdDate) 	VALUES('".$row['firstName']."',
					   '".$row['lastName']."',
					   '".$row['email']."',
					   '".$row['mobile']."',
					   '".$row['status']."',
					   '".$date."')";
			$customerId=$adapter->insert($query);
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
		global $adapter;
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
		$addressData = $adapter->fetchRow("SELECT * FROM address WHERE customerId = $customerId");
		
		if($addressData)
		{
			$query = "UPDATE address 
				SET address='".$row['address']."',
					city='".$row['city']."',
					state='".$row['state']."',
					country='".$row['country']."',
					postalCode=".$row['postalCode'].",
					billing=".$billing.",
					shipping=".$shipping."
				WHERE customerId='".$customerId."'";
			$update = $adapter->update($query);
			if(!$update)
			{ 

				throw new Exception("System is unable to update.", 1);
			}
		}
		else
		{
			$query = "INSERT INTO Address(customerId,address,city,state,country,postalCode,billing,shipping) 		
				VALUES($customerId,
					   '".$row['address']."',
					   '".$row['city']."',
					   '".$row['state']."',
					   '".$row['country']."',
					   '".$row['postalCode']."',
					   '".$billing."',
					   '".$shipping."')";
			$result=$adapter->insert($query);
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
			
			global $adapter;
			$id=$request->getRequest('id');
			$query = "DELETE FROM Customer WHERE customerId = ".$id;
			$delete = $adapter->delete($query); 
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