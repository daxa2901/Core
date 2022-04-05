<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php 

class Controller_ShippingMethod extends Controller_Admin_Action
{
	public function indexAction()
	{
		$this->setPageTitle('Shipping Method Page ');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$methodBlock = Ccc::getBlock('ShippingMethod_Grid')->toHtml();
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
		$this->setPageTitle('Shipping Method Add');
		$shippingMethod = Ccc::getModel('ShippingMethod');
		Ccc::register('shippingMethod',$shippingMethod);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$methodBlock = Ccc::getBlock('ShippingMethod_Edit')->toHtml();
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
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$methodBlock = Ccc::getBlock('ShippingMethod_Edit')->toHtml();
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
				$query = "DELETE FROM `shippingMethod`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `shippingMethod` WHERE `methodId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('shippingMethod detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}