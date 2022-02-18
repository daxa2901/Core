<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Customer_Add')->toHtml();
	}

	public function editAction()
	{
		try {
			$id = (int)$this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Id.", 1);
			}
			$customerTable = Ccc::getModel('Customer');
 			$query = "SELECT * FROM Customer  
			   WHERE customerId=".$id;
			$customer = $customerTable->fetchRow($query);

			if (!$customer) {
				throw new Exception("Unable to load Customer.", 1);
				
			}
			$query2 = "SELECT 
                  a.* 
                FROM 
              Address a 
                JOIN 
              Customer c ON a.customerId = c.customerId WHERE a.customerId =".$id;  
			$address = $customerTable-> fetchRow($query2);
			if (!$address) {
				throw new Exception("Unable to load Customer Address.", 1);
			}
			$customerBlock = Ccc::getBlock('Customer_Edit');
			$customerBlock->addData('customer',$customer);
			$customerBlock->addData('address',$address);			
			$customerBlock->toHtml();
		} catch (Exception $e) {
				echo $e->getMessage();		
		}
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
		$row = $request->getPost('customer');

		if (array_key_exists('customerId', $row)) 
		{
			if(!(int)$row['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row["customerId"];
			$row['updatedDate'] = date('Y-m-d H:i:s');
			unset($row['customerId']);
			$update = $customerTable->update($row,['customerId'=>$customerId]);
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else{
			$row['createdDate'] = date('Y-m-d H:i:s');
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
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));
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
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));	
				
		} catch (Exception $e) {
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('customer','grid',null,true));	
			//echo $e->getMessage();
		}
	}
}
