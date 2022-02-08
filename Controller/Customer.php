<?php
	require_once('Model\Core\Adapter.php');

class Controller_Customer{
	public function gridAction()
	{
		require_once('view/customer/grid.php');
	}

	public function addAction()
	{
		require_once('view/customer/add.php');
	}

	public function editAction()
	{
		require_once('view/customer/edit.php');
	}
	protected function saveCustomer()
	{
		if (!isset($_POST['customer'])) {
			throw new Exception("Invalid Request.", 1);				
		}
					
		global $adapter;
		$row = $_POST['customer'];

		if (array_key_exists('customerId', $row)) {
			if(!(int)$row['customerId']){
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row["customerId"];
			$query = "UPDATE Customer 
				SET firstName='".$row['firstName']."',
					lastName='".$row['lastName']."',
					email='".$row['email']."',
					mobile='".$row['mobile']."',
					status='".$row['status']."',
					updatedDate='".$adapter->currentDate()."' 
				WHERE customerId='".$customerId."'";

			$update = $adapter->update($query);
			if(!$update){ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else{
			$query = "INSERT INTO Customer(firstName,lastName,email,mobile,status,createdDate) 	VALUES('".$row['firstName']."',
					   '".$row['lastName']."',
					   '".$row['email']."',
					   '".$row['mobile']."',
					   '".$row['status']."',
					   '".$adapter->currentDate()."')";
			$customerId=$adapter->insert($query);
			if(!$customerId){	
					throw new Exception("System is unable to insert.", 1);
			}
			
		}

		return $customerId;
	
	}

	protected function saveAddress($customerId)
	{
		if (!isset($_POST['address'])) {
			throw new Exception("Invalid Request.", 1);				
		}
		global $adapter;
		$row = $_POST['address'];
	
		$billing=2;	
		$shipping=2;

		if (array_key_exists('billing', $row) && $row['billing'] == 1) {
				$billing = 1;			
		}
		if (array_key_exists('shipping', $row) && $row['shipping'] == 1) {
				$shipping = 1;
		}
		$addressData = $adapter->fetchRow("SELECT * FROM address WHERE customerId = $customerId");
		
		if($addressData){
			echo "hii";
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
			if(!$update){ 

				throw new Exception("System is unable to update.", 1);
			}
		}
		else{
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
			if (!$result) {
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
			
			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter;
			$id=$_GET['id'];
			$query = "DELETE FROM Customer WHERE customerId = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=customer&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('Customer.php?a=gridAction');	
			//echo $e->getMessage();
		}

		
	}

	public function redirect($url)
	{
	
		header('location:'.$url);	
		exit();			
	}

	public function errorAction()
	{
		echo "error";
	}
}
?>