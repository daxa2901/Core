<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Customer extends Controller_Admin_Action{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$customer = Ccc::getBlock('Customer_Grid');
		$content->addChild($customer);
		$this->renderLayout();
	}

	public function addAction()
	{
		$customer = Ccc::getModel('Customer');
		$address = Ccc::getModel('Customer_Address');
		$customerBlock = Ccc::getBlock('Customer_Edit');
		$customerBlock->setData(['customer'=>$customer]);
		$customerBlock->addData('address',$address);
		$content = $this->getLayout()->getContent();
		$content->addChild($customerBlock);
		$this->renderLayout();	
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

			$customerRow = Ccc::getBlock('Customer_Edit');
			$customerRow->setData(['customer'=>$customer]);
			$customerRow->addData('address',$address);	
			$content = $this->getLayout()->getContent();
			$content->addChild($customerRow);
			$this->renderLayout();	
		
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,null);		
		}
	}
	protected function saveCustomer()
	{
		$request=$this->getRequest();
    	
    	if(!$request->isPost() || !$request->getPost('customer')) 
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
			$customer = Ccc::getModel("Customer")->load($row['customerId']);
			$customer->updatedDate = date('Y-m-d H:i:s');
		}
		else
		{
			$customer = Ccc::getModel("Customer");
			$customer->createdDate = date('Y-m-d H:i:s');
		}

		$customer->setData($row);
		$customer = $customer->save();
		if(!$customer)
		{	
				throw new Exception("System is unable to insert.", 1);
		}
		$this->getMessage()->addMessage('Customer Details Inserted Successfully.');
	
		return $customer->customerId;
	}

	protected function saveAddress($customerId)
	{
		$request = $this->getRequest();
		
		if(!$request->isPost() ||!$request->getPost('address')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
		$row = $request->getPost('address');

		$vendorAddress = Ccc::getModel("Customer_Address")->load($customerId,'customerId');
		if(!$vendorAddress)
		{
			$vendorAddress = Ccc::getModel("Customer_Address");
			$vendorAddress->customerId = $customerId;
		}

		$vendorAddress->billing = get_class($vendorAddress)::BILLING_DEFAULT;
		$vendorAddress->shipping = get_class($vendorAddress)::SHIPPING_DEFAULT;
		if (array_key_exists('billing', $row) && $row['billing'] == 1) 
		{
			$vendorAddress->billing = get_class($vendorAddress)::BILLING;
		}

		if (array_key_exists('shipping', $row) && $row['shipping'] == 1) 
		{
			$vendorAddress->shipping = get_class($vendorAddress)::SHIPPING;
		}
		$vendorAddress->setData($row);
		$vendorAddress = $vendorAddress->save();
		if (!$vendorAddress) 
		{
			throw new Exception("System is unable to insert", 1);
		}
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->getMessage()->addMessage('Customer saved successfully.');
			$this->redirect('grid',null,null,true);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$customer = Ccc::getModel('Customer')->load($id);
			if(!$customer)
			{
				throw new Exception("record not found.", 1);
			}

			$customer = $customer->delete(); 
			if(!$customer)
			{
				throw new Exception("System is unable to delete record.", 1);
			}

			$this->getMessage()->addMessage('Customer details deleted successfully.');
			$this->redirect('grid',null,null,true);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,null,true);	
			
		}
	}
}
