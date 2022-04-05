<?php 
Ccc::loadClass('Controller_Admin_Action');

class Controller_Salseman_Customer extends Controller_Admin_Action
{
						
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
			$this->redirect('edit','Salseman');
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('edit','Salseman');
		}
	}
}
