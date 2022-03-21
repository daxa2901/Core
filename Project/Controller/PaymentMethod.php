<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php 

class Controller_PaymentMethod extends Controller_Admin_Action
{
	public function gridAction()
	{
		$this->setPageTitle('Payment Method Grid');
		$content = $this->getLayout()->getContent();
		$paymentMethod = Ccc::getBlock('PaymentMethod_Grid');
		$content->addChild($paymentMethod);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Payment Method Add');
		$paymentMethod = Ccc::getModel('PaymentMethod');
		$paymentMethodRow = Ccc::getBlock('PaymentMethod_Edit')->setdata(['paymentMethod'=>$paymentMethod]);
		$content = $this->getLayout()->getContent();
		$content->addChild($paymentMethodRow);
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$this->setPageTitle('Payment Method Edit');
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) 
      		{
      			throw new Exception("Invalid Id.", 1);
      		}

			$paymentMethod = Ccc::getModel('PaymentMethod')->load($id);
      		if (!$paymentMethod) 
      		{
      			throw new Exception("Unable to Load Payment Method.", 1);
      		}

      		$paymentMethodRow = Ccc::getBlock('PaymentMethod_Edit')->setdata(['paymentMethod'=>$paymentMethod]);
			$content = $this->getLayout()->getContent();
			$content->addChild($paymentMethodRow);
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
			$this->setPageTitle('Payment Method Save');
			$request = $this->getRequest();
			if(!$request->isPost() || !$request->getPost('payment'))
			{
				throw new Exception("Invalid Request", 1);
			}
			$row = $request->getPost('payment');
			if(array_key_exists('methodId',$row))
			{
				if(!(int)$row['methodId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$paymentMethod = Ccc::getModel('PaymentMethod')->load($row['methodId']);
				$paymentMethod->updatedAt = date('Y-m-d H:i:s');
			}
			else
			{
				$paymentMethod = Ccc::getModel('paymentMethod');
				$paymentMethod->createdAt = date('Y-m-d H:i:s');
				
			}
			$paymentMethod->setData($row);
			$paymentMethod = $paymentMethod->save();
			if (!$paymentMethod) 
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			$this->getMessage()->addMessage('Payment method saved successfully.');
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
			$this->setPageTitle('Payment method Delete');
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			
			$paymentMethod = Ccc::getModel('PaymentMethod')->load($id);
			if(!$paymentMethod)
			{
				throw new Exception("Record not found.", 1);
			}

			$paymentMethod = $paymentMethod->delete(); 
			if(!$paymentMethod)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->getMessage()->addMessage('Payment method deleted successfully.');
			$this->redirect('grid',null,['id'=>null]);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);	
		}
	}
}