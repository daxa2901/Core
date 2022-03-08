<?php 
Ccc::loadClass('Controller_Core_Action');

class COntroller_Salseman_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		try
		{
			$id = (int)$this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$product = Ccc::getModel('Salseman')->load($id);

			if (!$product) 
			{
				throw new Exception("Unable to load Salseman.", 1);
			}
			$customers = Ccc::getModel('Customer');
			$query = "SELECT * FROM customer WHERE salsemanId = {$id} OR salsemanId IS NULL";
			$customers = $customers->fetchAll($query);
			$salsemanCustomerRow =Ccc::getBlock('Salseman_Customer_Grid')->setData(['customers'=>$customers]);
			$content = $this->getLayout()->getContent();
			$content->addChild($salsemanCustomerRow);
			$this->renderLayout();

		}
		catch(Exception $e)
		{
			$messages = $this->getMessage();
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid','Salseman',null,true);
		}
		
	}
						
	public function saveAction()
	{
		try
		{
			$messages = $this->getMessage();
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
				echo $ids;
				$query = "UPDATE customer SET salsemanId = {$salsemanId} WHERE customerId IN ({$ids}) AND salsemanId IS NULL";
				echo $query;
				$update = $this->getAdapter()->update($query);
				if(!$update)
				{
					throw new Exception("Unable to update Salseman Customer.", 1);	
				}
				$messages->addMessage('Salseman Customer Updated Successfully.');
			}
			$this->redirect('grid');
		}
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid');
		}

	}
}
