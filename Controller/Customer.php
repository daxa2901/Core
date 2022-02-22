<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		$customerTable = Ccc::getModel("Customer");
	 echo "<pre>";
	 $customerTable->customerId = '79';
	 $customerTable->firstName = 'daxa';
	 $customerTable->lastName = 'devshibhai';
	 $customerTable->mobile = 12121;
	 $customerTable->email = 'dd@gmail.com';
	 $customerTable->status = '1';
	 $customerTable->createdDate = '2022-02-08 10:58:27';
	 // $c=$customerTable->getTableClassName();
	 // // echo $c;
	 // $a = $customerTable->getTable();
	 // echo $a->getPrimaryKey();
	 // print_r($a);
	 // print_r($customerTable);
	 print_r($customerTable->delete());
	 exit;

		// $customer = $customerTable->getRow();
		// print_r($customer);
		
		// $customerTable = Ccc::getModel("Customer_Row")->fetchAll("SELECT * FROM Customer");
		// echo "<pre>";
		// print_r($customerTable);
		// Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Customer_Add')->toHtml();
	}

	public function editAction()
	{
		try 
		{
			$id = (int)$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			
			$customerTable = Ccc::getModel('Customer');
 			$query = "SELECT * FROM Customer  
			   WHERE customerId=".$id;
			$customer = $customerTable->fetchRow($query);

			if (!$customer) 
			{
				throw new Exception("Unable to load Customer.", 1);
			}

			$query2 = "SELECT 
                  * 
                FROM 
              customer_address WHERE customerId =".$id;  
			$addressTable = Ccc::getModel('Customer_Address');
			$address = $addressTable-> fetchRow($query2);
			if (!$address) 
			{
				throw new Exception("Unable to load Customer Address.", 1);
			}
			$customerBlock = Ccc::getBlock('Customer_Edit');
			$customerBlock->addData('customer',$customer);
			$customerBlock->addData('address',$address);			
			$customerBlock->toHtml();
		} 
		catch (Exception $e) 
		{
				echo $e->getMessage();		
		}
	}
	protected function saveCustomer()
	{
		$customerTable = Ccc::getModel("Customer");
		$customerRow = $customerTable->getRow();
		
		$request=$this->getRequest();
    	
    	if(!$request->isPost())
		{
			throw new Exception("Invalid Request.", 1);				
		} 	
		if (!$request->getPost('customer')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
					
		$row = $request->getPost('customer');

		if (array_key_exists('customerId', $row)) 
		{
			if(!(int)$row['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row['customerId'];
			$customerRow->setData($row);
			$customerRow->updatedDate = date('Y-m-d H:i:s');
			$update = $customerRow->save();
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else
		{
			$customerRow->setData($row);
			$customerRow->createdDate = date('Y-m-d H:i:s');
			$customerId = $customerRow->save();
			if(!$customerId)
			{	
					throw new Exception("System is unable to insert.", 1);
			}
			
		}
	
		return $customerId;
	}

	protected function saveAddress($customerId)
	{

		$addressTable = Ccc::getModel("Customer_Address");
		$addressRow = $addressTable->getRow();
		$request = $this->getRequest();
		
		if(!$request->isPost())
		{
			throw new Exception("Invalid Request.", 1);				
		}
		if (!$request->getPost('address')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
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
		$query = "SELECT * FROM customer_address WHERE customerId = ".$customerId;
		$addressData = $addressTable->fetchRow($query);
		$addressRow->setData($row);
		$addressRow->billing = $billing;
		$addressRow->shipping = $shipping;
		if($addressData)
		{
			$addressRow->addressId = $addressData['addressId'];
			$update = $addressRow->save();
		
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
		}
		else
		{
			$addressRow->customerId = $customerId;
			$result = $addressRow->save();
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
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));
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
			
			$customerTable = Ccc::getModel('Customer');
			$id=$request->getRequest('id');
			$delete = $customerTable->delete($id); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));	
			//echo $e->getMessage();
		}
	}
}
