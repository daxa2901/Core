<?php 
Ccc::loadClass('Controller_Admin_Action');

class Controller_Salseman_Customer_Price extends Controller_Admin_Action
{
	public function gridAction()
	{
		try
		{
			$this->setPageTitle('Customer Price Grid');
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
			$query = "SELECT p.*,cp.`entityId`, cp.`price` as customerPrice FROM `product` p LEFT JOIN `customer_price` cp ON p.`productId` = cp.`productId` AND `customerId` = {$customerId} WHERE p.`status` = 1";
			$products = $products->fetchAll($query);
			Ccc::register('products',$products);
			Ccc::register('salseman',$salseman);
			$customerPriceBlock =Ccc::getBlock('Salseman_Customer_Price_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $customerPriceBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$customerPriceBlock =Ccc::getBlock('Salseman_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $customerPriceBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);
		}
	}
						
	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Customer Price Save');
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

				if (array_key_exists('exists',$price)) 
				{
					foreach ($customer->getPrices() as $key => $value) 
					{
						$value->price = $price['exists'][$value->entityId];
						$update = $value->save();
						if (!$update) 
						{
							throw new Exception("Unable to update.", 1);
						}
					}
				}
				
				$this->getMessage()->addMessage('Customer price saved successfully.');
			}
			$this->gridAction();
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->gridAction();
		}
	}
}
	