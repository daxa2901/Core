<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php 

class Controller_PaymentMethod extends Controller_Admin_Action
{
	public function indexAction()
	{
		$this->setPageTitle('Payment Method Page ');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$methodBlock = Ccc::getBlock('PaymentMethod_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $methodBlock
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
		$this->setPageTitle('Payment Method Add');
		$paymentMethod = Ccc::getModel('PaymentMethod');
      	Ccc::register('paymentMethod',$paymentMethod);
      	$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$methodBlock = Ccc::getBlock('PaymentMethod_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $methodBlock
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
      		Ccc::register('paymentMethod',$paymentMethod);
      		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$methodBlock = Ccc::getBlock('PaymentMethod_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $methodBlock
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
			$this->gridAction();
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
				$query = "DELETE FROM `paymentMethod`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `paymentMethod` WHERE `methodId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('paymentMethod detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}