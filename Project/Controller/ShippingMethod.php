<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php 

class Controller_ShippingMethod extends Controller_Admin_Action
{
	public function gridAction()
	{
		$this->setPageTitle('Shipping Method Grid');
		$content = $this->getLayout()->getContent();
		$shippingMethod = Ccc::getBlock('ShippingMethod_Grid');
		$content->addChild($shippingMethod);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Shipping Method Add');
		$shippingMethod = Ccc::getModel('ShippingMethod');
		Ccc::register('shippingMethod',$shippingMethod);
		$shippingMethodRow = Ccc::getBlock('ShippingMethod_Edit');
		$content = $this->getLayout()->getContent();
		$content->addChild($shippingMethodRow);
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Shipping Method Edit');
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) 
      		{
      			throw new Exception("Invalid Id.", 1);
      		}

			$shippingMethod = Ccc::getModel('ShippingMethod')->load($id);
      		if (!$shippingMethod) 
      		{
      			throw new Exception("Unable to Load Shipping Method.", 1);
      		}

			Ccc::register('shippingMethod',$shippingMethod);
      		$shippingMethodRow = Ccc::getBlock('ShippingMethod_Edit');
			$content = $this->getLayout()->getContent();
			$content->addChild($shippingMethodRow);
			$this->renderLayout();

		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function saveAction()
	{
		try 
		{
			$this->setPageTitle('shipping Method Save');
			$request = $this->getRequest();
			if(!$request->isPost() || !$request->getPost('shipping'))
			{
				throw new Exception("Invalid Request", 1);
			}
			$row = $request->getPost('shipping');
			if(array_key_exists('methodId',$row))
			{
				if(!(int)$row['methodId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$shippingMethod = Ccc::getModel('ShippingMethod')->load($row['methodId']);
				$shippingMethod->updatedAt = date('Y-m-d H:i:s');
			}
			else
			{
				$shippingMethod = Ccc::getModel('ShippingMethod');
				$shippingMethod->createdAt = date('Y-m-d H:i:s');
				
			}
			$shippingMethod->setData($row);
			$shippingMethod = $shippingMethod->save();
			if (!$shippingMethod) 
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			$this->getMessage()->addMessage('Shipping method saved successfully.');
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
			$this->setPageTitle('Shipping method Delete');
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			
			$shippingMethod = Ccc::getModel('ShippingMethod')->load($id);
			if(!$shippingMethod)
			{
				throw new Exception("Record not found.", 1);
			}

			$shippingMethod = $shippingMethod->delete(); 
			if(!$shippingMethod)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->getMessage()->addMessage('Shipping method deleted successfully.');
			$this->redirect('grid',null,['id'=>null]);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);	
		}
	}
}