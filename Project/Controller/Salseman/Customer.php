<?php 
Ccc::loadClass('Controller_Admin_Action');

class COntroller_Salseman_Customer extends Controller_Admin_Action
{
	public function gridAction()
	{
		try
		{
			$this->setPageTitle('Salseman Customer Grid');
			$id = (int)$this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$salseman = Ccc::getModel('Salseman')->load($id);

			if (!$salseman) 
			{
				throw new Exception("Unable to load Salseman.", 1);
			}
			$salsemanCustomer =Ccc::getBlock('Salseman_Customer_Grid')->setData(['id'=>$id]);
			$content = $this->getLayout()->getContent();
			$content->addChild($salsemanCustomer);
			$this->renderLayout();
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid','Salseman',null,true);
		}
		
	}
						
	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Salseman Customer Save');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$salsemanId = (int) $request->getRequest('id');
			if(!$salsemanId)
			{
				throw new Exception("Invalid Id.", 1);				
			}

			$customerRow = Ccc::getModel('Customer');
			if ($request->getPost('customer')) 
			{
				$customerIds =  $request->getPost('customer');
				$ids = implode(',',$customerIds);
				$query = "UPDATE `customer` SET `salsemanId` = {$salsemanId} WHERE `customerId` IN ({$ids}) AND `salsemanId` IS NULL";
				$update = $this->getAdapter()->update($query);
				if(!$update)
				{
					throw new Exception("Unable to update Salseman Customer.", 1);	
				}
				$this->getMessage()->addMessage('Salseman Customer Updated Successfully.');
			}
			$this->redirect('grid');
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid');
		}
	}
}
