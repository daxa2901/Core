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
		Ccc::register('customer',$customer);
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
			Ccc::register('customer',$customer);
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
		$billingAddress = $customer->getBillingAddress();
		$shippingAddress = $customer->getShippingAddress();
		$billingAddress->customerId = $customer->customerId;
		$billingAddress->type = get_class($billingAddress)::BILLING;
		$shippingAddress->type = get_class($shippingAddress)::SHIPPING;
		$shippingAddress->customerId = $customer->customerId;
		$billingAddress->save();
		$shippingAddress->save();
		return $customer;
	}

	protected function saveAddress($type = 'billing')
	{

		$request = $this->getRequest();
		$id =(int) $request->getRequest('id');
		if (!$id) 
		{
			throw new Exception("Invalid id.", 1);
		}

		$customer = Ccc::getModel('Customer')->load($id);
		if (!$customer) 
		{
			throw new Exception("No record found.", 1);
		}

		if(!$request->isPost() || !$request->getPost($type.'Address')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
		$customerAddress = $request->getPost($type.'Address');
		if ($type == 'billing') 
		{
			$address = $customer->getBillingAddress();
			if (array_key_exists('same',$customerAddress)) 
			 {
				$shippingAddress = $customer->getShippingAddress();
				$addressId = $shippingAddress->addressId;
				$shippingAddress->setData($customerAddress);
				
				if (!$shippingAddress->addressId) 
				{
					$shippingAddress->customerId = $customer->customerId;
				}
				else
				{
					$shippingAddress->addressId = $addressId;
				}

				$shippingAddress = $shippingAddress->save();
				if (!$shippingAddress) 
				{
					throw new Exception("System is unable to save address.", 1);
				}
			}
			else
			{
				$address->same = 2;
			}
		}
		else
		{
			$address = $customer->getShippingAddress();
			if ($address->same == 1) 
			{
				$billingAddress = $customer->getBillingAddress();
				$billingAddress->same = 2;
				$billingAddress->save();
				$address->same = 2;
			}
		}
		if (!$address->addressId) 
		{
			$address->customerId = $customer->customerId;
		}
		$address->setData($customerAddress);
		$address = $address->save();
		if (!$address) 
		{
			throw new Exception("System is unable to save address.", 1);
		}
		return $customer;
		
	}

	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Customer Address Save');
			if ($this->getRequest()->getPost('customer')) 
			{
				$customer = $this->saveCustomer();
				Ccc::register('customer',$customer);
			}
			if ($this->getRequest()->getPost('billingAddress')) 
			{
				$customer = $this->saveAddress();
			}
			if ($this->getRequest()->getPost('shippingAddress')) 
			{
				$customer = $this->saveAddress('shipping');
			}
		
			$this->getMessage()->addMessage('Customer saved successfully.');
			if ($this->getRequest()->getPost('submit')) 
			{
				$this->redirect('edit',null,['id'=>$customer->customerId]);
			}
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
