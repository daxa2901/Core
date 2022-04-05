<?php
Ccc::loadClass('Controller_Admin_Action');

class Controller_Vendor extends Controller_Admin_Action
{
	public function indexAction()
	{
		$this->setPageTitle('Vendor Page ');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$vendorBlock = Ccc::getBlock('Vendor_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $vendorBlock
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
		$this->setPageTitle('Vendor Address Add');
		$vendor = Ccc::getModel('Vendor');
		Ccc::register('vendor',$vendor);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$vendorBlock = Ccc::getBlock('Vendor_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $vendorBlock
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
			Ccc::register('vendor',$vendor);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$vendorBlock = Ccc::getBlock('Vendor_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $vendorBlock
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
			$this->gridAction();	
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
		return $vendor;
	}

	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Vendor Address Save');
			if ($this->getRequest()->getPost('vendor')) 
			{
				$vendor = $this->saveVendor();
				Ccc::register('vendor',$vendor);
				if($this->getRequest()->getRequest('tab')=='address')
				{
					$this->getMessage()->addMessage('Vendor details saved successfully.');
					$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
					$vendorBlock = Ccc::getBlock('Vendor_Edit')->toHtml();
					$response = [
						'status' => 'success',
						'elements' =>[
								[
									'element' => '#indexContent',
									'content' => $vendorBlock
								],

								[
									'element' => '#indexMessage',
									'content' => $messageBlock
								]

							]
						];
					$this->renderJson($response);
				}
				else
				{
					$this->getMessage()->addMessage('Vendor details saved successfully.');
					$this->gridAction();
				}
			}
			elseif ($this->getRequest()->getPost('address')) 
			{
				$vendorId = (int)$this->getRequest()->getPost('vendorId');
				if (!$vendorId) 
				{
					throw new Exception("First enter details of vendor.", 1);
				}
				$vendor = Ccc::getModel('vendor')->load($vendorId);
				if (!$vendor) 
				{
					throw new Exception("No record found.", 1);
				}
				$vendor = $this->saveAddress($vendor);
				$this->getMessage()->addMessage('Vendor details saved successfully.');
				$this->gridAction();	
			}
			else
			{
				$this->gridAction();	
			}
			
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->gridAction();	
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
			$this->gridAction();	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->gridAction();	
		}
	}


	public function multipleDeleteAction()
	{
		try 
		{
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if(!$request->isPost('delete'))
			{
				throw new Exception("Invalid Request.", 1);				
			}
			
			$row = $request->getPost('delete');
			if (array_key_exists('all',$row)) 
			{
				$query = "DELETE FROM `vendor`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `vendor` WHERE `vendorId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('Vendor detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}
