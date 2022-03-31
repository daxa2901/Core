<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Customer extends Controller_Admin_Action{

	public function indexAction()
	{
		$this->setPageTitle('Customer Address Page');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$customerBlock = Ccc::getBlock('Customer_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
		
	}

	public function addAction()
	{
		$this->setPageTitle('Customer Address Add');
		$customer = Ccc::getModel('Customer');
		Ccc::register('customer',$customer);
		$customerBlock = Ccc::getBlock('Customer_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);

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
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$customerBlock = Ccc::getBlock('Customer_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
			$this->renderJson($response);

		
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$customerBlock = Ccc::getBlock('Customer_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
			$this->renderJson($response);
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

	protected function saveAddress()
	{

		$request = $this->getRequest();
		if (!array_key_exists('customer',$request->getPost())) 
		{
			throw new Exception("First enter details of customer.", 1);
		}
		$customer =$request->getPost('customer');
		$customer = Ccc::getModel('Customer')->load($customer['customerId']);

		if (!$customer) 
		{
			throw new Exception("No record found.", 1);
		}

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
		
		$billingAddress->type = get_class($billingAddress)::BILLING;
		$shippingAddress->type = get_class($shippingAddress)::SHIPPING;
		
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
		return $customer;
		
	}

	public function saveAction()
	{
		try
		{
			if ($this->getRequest()->getPost('customer')) 
			{
				$customer = $this->saveCustomer();
				Ccc::register('customer',$customer);

			}
			if ($this->getRequest()->getPost('billingAddress')) 
			{
				$customer = $this->saveAddress();
			}
			$this->getMessage()->addMessage('Customer saved successfully.');
			
			$customerBlock = Ccc::getBlock('Customer_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
			$this->renderJson($response);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$customerBlock = Ccc::getBlock('Customer_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
			$this->renderJson($response);
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
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$customerBlock = Ccc::getBlock('Customer_Grid')->toHtml();
			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
			$this->renderJson($response);
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$customerBlock = Ccc::getBlock('Customer_Grid')->toHtml();
			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $customerBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
			$this->renderJson($response);
		}
	}
}
