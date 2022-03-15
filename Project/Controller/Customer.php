<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Customer extends Controller_Admin_Action{
	public function gridAction()
	{
		$this->setPageTitle('Customer Address Grid');
		$content = $this->getLayout()->getContent();
		$customer = Ccc::getBlock('Customer_Grid');
		$content->addChild($customer);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Customer Address Add');
		$customer = Ccc::getModel('Customer');
		$customerBlock = Ccc::getBlock('Customer_Edit');
		$customerBlock->setData(['customer'=>$customer]);
		$content = $this->getLayout()->getContent();
		$content->addChild($customerBlock);
		$this->renderLayout();	
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Customer Address Edit');
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
			$customerRow = Ccc::getBlock('Customer_Edit');
			$customerRow->setData(['customer'=>$customer]);
			$content = $this->getLayout()->getContent();
			$content->addChild($customerRow);
			$this->renderLayout();	
		
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);		
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
	
		return $customer;
	}

	protected function saveAddress($customer)
	{
		$request = $this->getRequest();
		
		if(!$request->isPost() || !$request->getPost('billingAddress')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}

		$customerBillingAddress = $request->getPost('billingAddress');
		$customerShippingAddress = (array_key_exists('same',$customerBillingAddress)) ? $customerBillingAddress : $request->getPost('shippingAddress');

		$billingAddress = $customer->getBillingAddress();
		$shippingAddress = $customer->getShippingAddress();
		if(!$billingAddress->customerId || !$shippingAddress->customerId)
		{
			$billingAddress->customerId = $customer->customerId;
			$shippingAddress->customerId = $customer->customerId;
		}
		else
		{
			$shippingAddressId = $request->getPost('shippingAddress');
			$customerShippingAddress['addressId'] = $shippingAddressId['addressId'];
		}
		
		$billingAddress->billing = get_class($billingAddress)::BILLING;
		$shippingAddress->shipping = get_class($shippingAddress)::SHIPPING;
		
		$billingAddress->setData($customerBillingAddress);
		$billingAddress->same = (array_key_exists('same',$customerBillingAddress)) ? 1 : 2;
		$billingAddress = $billingAddress->save();
		if (!$billingAddress) 
		{
			throw new Exception("System is unable to insert", 1);
		}

		$shippingAddress->setData($customerShippingAddress);
		$shippingAddress->same = (array_key_exists('same',$customerBillingAddress)) ? 1 : 2;
		$shippingAddress = $shippingAddress->save();
		if (!$shippingAddress ) 
		{
			throw new Exception("System is unable to insert", 1);
		}
	}

	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Customer Address Save');
			$customer = $this->saveCustomer();
			$this->saveAddress($customer);
			$this->getMessage()->addMessage('Customer saved successfully.');
			$this->redirect('grid',null,['id'=>null]);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$this->setPageTitle('Customer Address Delete');
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
			$this->redirect('grid',null,['id'=>null]);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);	
			
		}
	}
}
