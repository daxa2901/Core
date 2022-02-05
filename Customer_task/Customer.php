<?php
	require_once('C:\xampp\htdocs\Cybercom\Core\AdapterClass\Adapter.php');

class Customer{
	public function gridAction()
	{
		require_once('Customer-grid.php');
	}

	public function addAction()
	{
		require_once('Customer-add.php');
	}

	public function editAction()
	{
		require_once('Customer-edit.php');
	}

	public function saveAction()
	{
		try {
			if (!isset($_POST['customer'])) {
				throw new Exception("Invalid Request.", 1);				
			}
						
			global $adapter;
			$row = $_POST['customer'];
			if (array_key_exists('customer_id', $row)) {
				if(!(int)$row['customer_id']){
					throw new Exception("Invalid Request.", 1);
				}
				$query = "UPDATE Customer 
					SET firstName='".$row['firstName']."',
						lastName='".$row['lastName']."',
						email='".$row['email']."',
						mobile='".$row['mobile']."',
						status='".$row['status']."',
						updatedDate='".$adapter->currentDate()."' 
					WHERE customer_id='".$row['customer_id']."'";

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
				$insert=$adapter->insert($query);
				if(!$insert){	
						throw new Exception("System is unable to insert.", 1);
				}
				$shipping = 2;
				$billing = 2;
				$address = $_POST['address'];
				if (array_key_exists('billing', $address)) {

						$billing = 1;			
				}
				if (array_key_exists('shipping', $address)) {
						$shipping = 1;
				}
				$query = "INSERT INTO Address(customerId,address,city,state,country,postalCode,billing,shipping) 	
					
					VALUES($insert,
						   '".$address['address']."',
						   '".$address['city']."',
						   '".$address['state']."',
						   '".$address['country']."',
						   '".$address['postalCode']."',
						   '".$billing."',
						   '".$shipping."')";
				$result=$adapter->insert($query);
				if (!$result) {
					print_r($result);
					exit();
					throw new Exception("System is unable to insert", 1);
				}
				
			}
			$this->redirect('Customer.php?a=gridAction');
			
		} catch (Exception $e) {
			$this->redirect('Customer.php?a=gridAction');
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
			$query = "DELETE FROM Customer WHERE customer_id = ".$id;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('Customer.php?a=gridAction');	
				
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

$customer = new Customer();
$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$customer->$action(); 
?>