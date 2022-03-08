<?php 
Ccc::loadClass('Controller_Core_Action');

class COntroller_Customer_Price extends Controller_Core_Action
{
	public function gridAction()
	{
		try
		{
			$salsemanId = (int)$this->getRequest()->getRequest('id');
			$customerId = (int)$this->getRequest()->getRequest('customerId');
			if(!$customerId OR !$salsemanId)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if (!$customer) 
			{
				throw new Exception("Unable to load Customer.", 1);
			}
			$salseman = Ccc::getModel('Salseman')->load($salsemanId);
			if (!$salseman) 
			{
				throw new Exception("Unable to load Salseman.", 1);
			}
			if ($salsemanId != $customer->salsemanId) 
			{
				throw new Exception("Invalid salsemanId.", 1);
			}	

			$products = Ccc::getModel('Product');
			$query = "SELECT p.*,cp.entityId, cp.price as customerPrice FROM product p LEFT JOIN customer_price cp ON p.productId = cp.productId AND customerId = {$customerId} WHERE p.status = 1";
			$products = $products->fetchAll($query);
			$customerPriceGrid =Ccc::getBlock('Customer_Price_Grid');
			$customerPriceGrid->setData(['products'=>$products]);
			$customerPriceGrid->addData('salseman',$salseman);
			$content = $this->getLayout()->getContent();
			$content->addChild($customerPriceGrid);
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
			$customerId = (int) $request->getRequest('customerId');
			if(!$customerId)
			{
				throw new Exception("Invalid Id.", 1);				
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Customer.", 1);
				
			}

			if ($request->getPost('price')) 
			{
				$price =  $request->getPost('price');
				if (array_key_exists('new',$price)) 
				{
					foreach ($price['new'] as $key => $value) 
					{
						$customerPriceRow = Ccc::getModel('Customer_Price');
						$customerPriceRow->customerId = $customerId;
						$customerPriceRow->productId = $key;
						$customerPriceRow->price = $value;
						$insert = $customerPriceRow->save();
						if (!$insert) 
						{
							throw new Exception("Unable to insert.", 1);
							
						}
					}
				}

				if (array_key_exists('old',$price)) 
				{
					foreach ($price['old'] as $key => $value) 
					{
						$customerPriceRow = Ccc::getModel('Customer_Price');
						$customerPriceRow->entityId = $key;
						$customerPriceRow->price = $value;
						$update = $customerPriceRow->save();
						if (!$update) 
						{
							throw new Exception("Unable to update.", 1);
							
						}
					}

				}
				
				$messages->addMessage('Customer price saved successfully.');
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
