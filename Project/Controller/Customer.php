<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		$customer = Ccc::getModel('Customer');
		$address = Ccc::getModel('Customer_Address');
		$customerBlock = Ccc::getBlock('Customer_Edit');
		$customerBlock->setData(['customer'=>$customer]);
		$customerBlock->addData('address',$address);	
		$customerBlock->toHtml();
		// Ccc::getBlock('Customer_Add')->toHtml();
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
			
			$customer = Ccc::getModel('Customer')->load($id);

			if (!$customer) 
			{
				throw new Exception("Unable to load Customer.", 1);
			}

			$address = Ccc::getModel('Customer_Address')->load($id,'customerId');
			if (!$address) 
			{
				throw new Exception("Unable to load Customer Address.", 1);
			}
			$customerBlock = Ccc::getBlock('Customer_Edit');
			$customerBlock->setData(['customer'=>$customer]);
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
		$customerRow = Ccc::getModel("Customer");
		
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

		$addressRow = Ccc::getModel("Customer_Address");
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
		$addressData = $addressRow->load($customerId);
		$addressRow->setData($row);
		$addressRow->billing = $billing;
		$addressRow->shipping = $shipping;
		if($addressData)
		{
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
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('grid',null,null,true));
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
			
			$customerRow = Ccc::getModel('Customer');
			$id=$request->getRequest('id');
			$customerRow= $customerRow->load($id);
			if(!$customerRow)
			{
				throw new Exception("record not found.", 1);
			}
			$delete = $customerRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('grid',null,null,true));	
			//echo $e->getMessage();
		}
	}
}
