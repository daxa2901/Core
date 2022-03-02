<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Vendor extends Controller_Core_Action{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$vendorRow = Ccc::getBlock('Vendor_Grid');
		$content->addChild($vendorRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$vendor = Ccc::getModel('Vendor');
		$address = Ccc::getModel('Vendor_Address');
		$vendorRow = Ccc::getBlock('Vendor_Edit');
		$vendorRow->setData(['vendor'=>$vendor]);
		$vendorRow->addData('address',$address);
		$content = $this->getLayout()->getContent();
		$content->addChild($vendorRow);
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
			
			$vendor = Ccc::getModel('Vendor')->load($id);

			if (!$vendor) 
			{
				throw new Exception("Unable to load vendor.", 1);
			}

			$address = Ccc::getModel('Vendor_Address')->load($id,'vendorId');
			if (!$address) 
			{
				throw new Exception("Unable to load vendor Address.", 1);
			}
			$vendorRow = Ccc::getBlock('Vendor_Edit');
			$vendorRow->setData(['vendor'=>$vendor]);
			$vendorRow->addData('address',$address);	
			$content = $this->getLayout()->getContent();
			$content->addChild($vendorRow);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
				echo $e->getMessage();		
		}
	}
	protected function saveVendor()
	{
		$vendorRow = Ccc::getModel("Vendor");
		
		$request=$this->getRequest();
    	
    	if(!$request->isPost())
		{
			throw new Exception("Invalid Request.", 1);				
		} 	
		if (!$request->getPost('vendor')) 
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
			$vendorId = $row['vendorId'];
			$vendorRow->setData($row);
			$vendorRow->updatedAt = date('Y-m-d H:i:s');
			$update = $vendorRow->save();
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else
		{
			$vendorRow->setData($row);
			$vendorRow->createdAt = date('Y-m-d H:i:s');
			$vendorId = $vendorRow->save();
			if(!$vendorId)
			{	
					throw new Exception("System is unable to insert.", 1);
			}
			
		}
	
		return $vendorId;
	}

	protected function saveAddress($vendorId)
	{

		$vendorRow = Ccc::getModel("Vendor_Address");
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
	
		$addressData = $vendorRow->load($customerId);
		$vendorRow->setData($row);
		if($addressData)
		{
			$update = $vendorRow->save();
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
		}
		else
		{
			$vendorRow->vendorId = $vendorId;
			$result = $vendorRow->save();
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
			$vendorId = $this->saveVendor();
			$this->saveAddress($vendorId);
			$this->redirect(Ccc::getBlock('Vendor_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Vendor_Grid')->getUrl('grid',null,null,true));
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
			
			$vendorId = Ccc::getModel('Vendor');
			$id=$request->getRequest('id');
			$vendorId= $vendorId->load($id);
			if(!$vendorId)
			{
				throw new Exception("record not found.", 1);
			}
			$delete = $vendorId->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Vendor_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Vendor_Grid')->getUrl('grid',null,null,true));	
			//echo $e->getMessage();
		}
	}
}
