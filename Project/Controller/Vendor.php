<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Vendor extends Controller_Admin_Action{
	public function gridAction()
	{
		$this->setPageTitle('Vendor Address Grid');
		$content = $this->getLayout()->getContent();
		$vendorRow = Ccc::getBlock('Vendor_Grid');
		$content->addChild($vendorRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Vendor Address Add');
		$vendor = Ccc::getModel('Vendor');
		$vendorRow = Ccc::getBlock('Vendor_Edit');
		$vendorRow->setData(['vendor'=>$vendor]);
		$content = $this->getLayout()->getContent();
		$content->addChild($vendorRow);
		$this->renderLayout();	
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Vendor Address Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			
			$vendor = Ccc::getModel('Vendor')->load($id);
			if (!$vendor) 
			{
				throw new Exception("Unable to load vendor.", 1);
			}
			$vendorRow = Ccc::getBlock('Vendor_Edit');
			$vendorRow->setData(['vendor'=>$vendor]);
			$content = $this->getLayout()->getContent();
			$content->addChild($vendorRow);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);	
			$this->redirect('grid',null,['id'=>null]);	
		}
	}
	protected function saveVendor()
	{
		$request=$this->getRequest();
    	if(!$request->isPost() || !$request->getPost('vendor')) 
    	{
			throw new Exception("Invalid Request.", 1);				
    	}
					
		$row = $request->getPost('vendor');
		if (array_key_exists('vendorId', $row)) 
		{
			if(!(int)$row['vendorId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$vendor = Ccc::getModel("Vendor")->load($row['vendorId']);
			$vendor->updatedAt = date('Y-m-d H:i:s');
		}
		else
		{
			$vendor = Ccc::getModel("Vendor");
			$vendor->createdAt = date('Y-m-d H:i:s');
		}

		$vendor->setData($row);
		$vendor = $vendor->save();
		if(!$vendor)
		{	
				throw new Exception("System is unable to insert.", 1);
		}
		$this->getMessage()->addMessage("Vendor details saved successfully.");
	
		return $vendor;
	}

	protected function saveAddress($vendor)
	{
		$request = $this->getRequest();
		
		if(!$request->isPost() || !$request->getPost('address')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
		
		$row = $request->getPost('address');
		$vendorAddress = $vendor->getAddress();
		if(!$vendorAddress->vendorId)
		{
			$vendorAddress = Ccc::getModel("Vendor_Address");
			$vendorAddress->vendorId = $vendor->vendorId;
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
			$this->setPageTitle('Vendor Address Save');
			$vendor = $this->saveVendor();
			$this->saveAddress($vendor);
			$this->getMessage()->addMessage('Vendor details saved successfully.');
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
			$this->setPageTitle('Vendor Address Delete');
			$id = $this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$vendor = Ccc::getModel('Vendor')->load($id);
			if(!$vendor)
			{
				throw new Exception("record not found.", 1);
			}
			
			$vendor = $vendor->delete(); 
			if(!$vendor)
			{
				throw new Exception("System is unable to delete record.", 1);							
			}

			$this->getMessage()->addMessage('Vendor Details Deleted Successfully.');
			$this->redirect('grid',null,['id'=>null]);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);	
		}
	}
}
