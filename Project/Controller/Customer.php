<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$customerRow = Ccc::getBlock('Customer_Grid');
		$content->addChild($customerRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$customer = Ccc::getModel('Customer');
		$address = Ccc::getModel('Customer_Address');
		$customerRow = Ccc::getBlock('Customer_Edit');
		$customerRow->setData(['customer'=>$customer]);
		$customerRow->addData('address',$address);
		$content = $this->getLayout()->getContent();
		$content->addChild($customerRow);
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
			$messages = $this->getMessage();
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,null);		
		}
	}
	protected function saveCustomer()
	{
		$messages = $this->getMessage();
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
			$messages->addMessage('Customer Details Updated Successfully.');
			
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
			$messages->addMessage('Customer Details Inserted Successfully.');
			
		}
	
		return $customerId;
	}

	protected function saveAddress($customerId)
	{
		$messages = $this->getMessage();
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
		$addressData = $addressRow->load($customerId,'customerId');
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
			$messages->addMessage('Customer Address Updated Successfully');
		}
		else
		{
			$addressRow->customerId = $customerId;
			$insert = $addressRow->save();
			if (!$insert) 
			{
				throw new Exception("System is unable to insert", 1);
			}
			$messages->addMessage('Customer Address Inserted Successfully.');
		}	
	}

	public function saveAction()
	{
		try
		{
			$messages = $this->getMessage();
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->redirect('grid',null,null,true);
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$messages = $this->getMessage();
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
			$messages->addMessage('Customer Details Deleted Successfully.');
			$this->redirect('grid',null,null,true);	
				
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);	
			
		}
	}
}
