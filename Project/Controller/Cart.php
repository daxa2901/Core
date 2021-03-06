<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Cart extends Controller_Admin_Action
{

	public function indexAction()
	{
		$this->setPageTitle('Cart Page');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}
	
	public function gridAction()
	{	
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $cartBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);

		// $this->setPageTitle('Cart Grid');
		// $content = $this->getLayout()->getContent();
		// Ccc::register('cart',$this->getMessage()->getSession()->cart);
		// $cart = Ccc::getBlock('Cart_Grid')->setdata(['cart'=>$this->getMessage()->getSession()->cart]);
		// $content->addChild($cart);
		// $this->renderLayout();
	}

	public function createCartAction()
	{
		try 
		{
			$id=(int)$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid id.", 1);
			}
			$customer = Ccc::getModel('Customer')->load($id);
			if (!$customer) 
			{
				throw new Exception("No record found.", 1);
			}
			$cart = $customer->getCart();
			if (!$cart->cartId) 
			{
				$cart->customerId = $id;
				$cart->createdAt = date('Y-m-d H:i:s');
				$cart = $cart->save();
				if(!$cart)
				{
					throw new Exception("System is unable to insert.", 1);
				}
				$billingAddress = $cart->getBillingAddress();
				if (!$billingAddress->addressId) 
				{
					$billingAddress->setData($customer->getBillingAddress()->getData());
					unset($billingAddress->addressId);
					unset($billingAddress->customerId);
					$billingAddress->firstName = $customer->firstName;
					$billingAddress->lastName = $customer->lastName;
					$billingAddress->email = $customer->email;
					$billingAddress->mobile = $customer->mobile;
					$billingAddress->cartId = $cart->cartId;
					$billingAddress->createdAt = date('Y-m-d H:i:s');
					$billingAddress = $billingAddress->save();
					if (!$billingAddress) 
					{
						throw new Exception("System is unable to insert.", 1);
						
					}
				}

				$shippingAddress = $cart->getShippingAddress();
				if (!$shippingAddress->addressId) 
				{
					$shippingAddress->setData($customer->getShippingAddress()->getData());
					unset($shippingAddress->addressId);
					unset($shippingAddress->customerId);
					$shippingAddress->firstName = $customer->firstName;
					$shippingAddress->lastName = $customer->lastName;
					$shippingAddress->email = $customer->email;
					$shippingAddress->mobile = $customer->mobile;
					$shippingAddress->cartId = $cart->cartId;
					$shippingAddress->createdAt = date('Y-m-d H:i:s');
					$shippingAddress = $shippingAddress->save();
					if (!$shippingAddress) 
					{
						throw new Exception("System is unable to insert.", 1);
						
					}
				}
			}
			$adminSession = Ccc::getModel('Admin_Session');
			$adminSession->cart = $cart->cartId;
			// Ccc::getBlock('Cart_Grid')->setdata(['cart'=>$this->getMessage()->getSession()->cart]);
			Ccc::register('cart',$this->getMessage()->getSession()->cart);
			$this->getMessage()->addMessage('Cart loaded successfully.');
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $cartBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);
			// $this-s>redirect('grid',null,['id'=>null]);

		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			Ccc::getBlock('Cart_Grid')->setdata(['cart'=>$this->getMessage()->getSession()->cart]);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $cartBlock
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
			$this->setPageTitle('Cart Item Save');
			$request = $this->getRequest();
			$cartId = Ccc::getModel('Admin_Session')->cart;
			if(!$request->isPost() || !$request->getPost('cart'))
			{
				throw new Exception("Invalid Request", 1);
			}
			$cart = $request->getPost('cart');
			$quantity = $cart['quantity'];
			if (array_key_exists('itemId',$cart)) 
			{
				$discount = $cart['discount'];
				$discountMode = $cart['discountMode'];
				$subtotal = 0;
				foreach ($cart['itemId'] as $itemId => $price) 
				{

					$cartItem = Ccc::getModel('Cart_Item')->load($itemId);
					$product = $cartItem->getProduct();
					$cartItem->quantity = $quantity[$itemId];
					$cartItem->discount = $discount[$itemId];
					$cartItem->discountMode = $discountMode[$itemId];
					$cartItem->taxAmount = ($product->price * ($cartItem->taxPercentage /100) * $quantity[$itemId]);
					$cartItem->updatedAt = date('Y-m-d H:i:s');
					$finalPrice = $cartItem->getFinalPrice();
					if (!$finalPrice) 
					{
						throw new Exception("Invalid discount.", 1);
					}
					$cartItem = $cartItem->save();
					if (!$cartItem) 
					{
						throw new Exception("System is unable to update.", 1);
					}
					$subtotal += $quantity[$itemId]*$price;
				}
				$cartRow = Ccc::getModel('Cart')->load($cartId);
				$cartRow->updatedAt = date('Y-m-d H:i:s');
				$cartRow->subTotal =  $subtotal;
				$cartRow = $cartRow->save();
				if (!$cartRow) 
				{
					throw new Exception("System is unable to update.", 1);
				}
			}
			if (array_key_exists('productId',$cart)) 
			{
				$subtotal = 0;
				foreach ($cart['productId'] as $key => $value) 
				{
					$product= Ccc::getModel('Product')->load($value);
					$itemModel = Ccc::getModel('Cart_Item');
					$itemModel->cartId = $cartId;
					$itemModel->productId = $value;
					$itemModel->cost = $product->cost;
					$itemModel->quantity = $quantity[$value];
					$itemModel->discount = $product->discount;
					$itemModel->discountMode = $product->discountMode;
					$itemModel->taxPercentage = $product->tax;
					$itemModel->taxAmount = ($product->price * ($product->tax/100))*$quantity[$value];
					$itemModel->createdAt = date('Y-m-d H:i:s');
					$itemModel = $itemModel->save();
					if (!$itemModel) 
					{
						throw new Exception("System is unable to insert.", 1);
					}
					$subtotal = $subtotal + ($itemModel->quantity * $itemModel->getProduct()->price);
				}
				$cartRow = Ccc::getModel('Cart')->load($cartId);
				$cartRow->updatedAt = date('Y-m-d H:i:s');
				$cartRow->subTotal = $cartRow->subTotal + $subtotal;
				$cartRow = $cartRow->save();
				if (!$cartRow) 
				{
					throw new Exception("System is unable to update.", 1);
				}
			}

			if (array_key_exists('shippingMethod',$cart)) 
			{

				$shippingMethod = Ccc::getModel('ShippingMethod')->load($cart['shippingMethod']);
				$cartRow = Ccc::getModel('Cart')->load($cartId);
				$cartRow->updatedAt = date('Y-m-d H:i:s');
				$cartRow->shippingMethodId = $shippingMethod->methodId;				
				$cartRow->shippingCost = $shippingMethod->amount;	
				$cartRow = $cartRow->save();
				if (!$cartRow) 
				{
					throw new Exception("System is unable to update.", 1);
				}			
			}
			
			if (array_key_exists('paymentMethod',$cart)) 
			{

				$paymentMethod = Ccc::getModel('PaymentMethod')->load($cart['paymentMethod']);
				$cartRow = Ccc::getModel('Cart')->load($cartId);
				$cartRow->updatedAt = date('Y-m-d H:i:s');
				$cartRow->paymentMethodId = $paymentMethod->methodId;				
				$cartRow = $cartRow->save();
				if (!$cartRow) 
				{
					throw new Exception("System is unable to update.", 1);
				}			
			}
			
			if (array_key_exists('billingAddress',$cart)) 
			{
				$billingAddress = $cart['billingAddress'];
				$cartRow = Ccc::getModel('Cart')->load($cartId);
				$billing = $cartRow->getBillingAddress();
				$billing->setData($billingAddress);
				if(!array_key_exists('same',$billingAddress)) {
					$billing->same = 2;
				}
				
				$billing->updatedAt = date('Y-m-d H:i:s');
				unset($billing->saveToAddress);
				$billing = $billing->save();
				if (!$billing) 
				{
					throw new Exception("System is unable to update.", 1);
				}
				if (array_key_exists('same',$billingAddress))
				{
					$shipping = $cartRow->getShippingAddress();
					$shippingAddressId = $shipping->addressId;
					$shipping->setData($billingAddress);
					unset($shipping->saveToAddress);
					$shipping->updatedAt = date('Y-m-d H:i:s');
					$shipping = $shipping->save();
					if (!$shipping) 
					{
						throw new Exception("System is unable to update.", 1);
					}
				}

				if (array_key_exists('saveToAddress',$billingAddress))
				{
					unset($billingAddress['saveToAddress']);
					unset($billingAddress['firstName']);
					unset($billingAddress['lastName']);
					unset($billingAddress['email']);
					unset($billingAddress['mobile']);
					$customerBillingAddress = $cartRow->getCustomer()->getBillingAddress();
					$customerBillingAddress->setData($billingAddress);
					if(!array_key_exists('same',$billingAddress)) 
					{
						$customerBillingAddress->same = 2;
					}
				
					$customerBillingAddress = $customerBillingAddress->save();
					if (!$customerBillingAddress) 
					{
						throw new Exception("System is unable to update.", 1);
					}
					if (array_key_exists('same',$billingAddress))
					{
						$customerShippingAddress = $cartRow->getCustomer()->getShippingAddress();
						$customerShippingAddress->setData($billingAddress);
						$customerShippingAddress = $customerShippingAddress->save();
						if (!$customerShippingAddress) 
						{
							throw new Exception("System is unable to update.", 1);
						}
					}
				}
			}
			
			if (array_key_exists('shippingAddress',$cart)) 
			{
				$shippingAddress = $cart['shippingAddress'];
				$shippingAddress['same'] = 2;
				$cartRow = Ccc::getModel('Cart')->load($cartId);
				$shipping = $cartRow->getShippingAddress();
				$shipping->setData($shippingAddress);
				$shipping->updatedAt = date('Y-m-d H:i:s');
				unset($shipping->saveToAddress);
				$shipping = $shipping->save();
				if (!$shipping) 
				{
					throw new Exception("System is unable to update.", 1);
				}

				if (array_key_exists('saveToAddress',$shippingAddress)) 
				{
					unset($shippingAddress['saveToAddress']);
					unset($shippingAddress['firstName']);
					unset($shippingAddress['lastName']);
					unset($shippingAddress['email']);
					unset($shippingAddress['mobile']);
					$customerShippingAddress = $cartRow->getCustomer()->getShippingAddress();
					$customerShippingAddress->setData($shippingAddress);
					$customerShippingAddress = $customerShippingAddress->save();
					if (!$customerShippingAddress) 
					{
						throw new Exception("System is unable to update.", 1);
					}
				}
			}

			$this->getMessage()->addMessage("Cart items Saved successfully....",1);
			Ccc::register('cart',$this->getMessage()->getSession()->cart);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $cartBlock
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
			Ccc::register('cart',$this->getMessage()->getSession()->cart);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $cartBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);
			// $this->redirect('grid');		
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$this->setPageTitle('Cart Item Delete');
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			$item = Ccc::getModel('Cart_Item')->load($id);
			if(!$item)
			{
				throw new Exception("Record not found.", 1);
			}
			$cart = $item->getCart();
			$rowTotal = $item->getProduct()->price * $item->quantity;
			$cart->subTotal = $cart->subTotal - $rowTotal;
			$cart->updatedAt = date('Y-m-d H:i:s');
			$cart = $cart->save();
			if(!$cart)
			{
				throw new Exception("System is unable to update.", 1);
			}

			$item = $item->delete(); 
			if(!$item)
			{
				throw new Exception("System is unable to delete record.", 1);
			}
			Ccc::register('cart',$this->getMessage()->getSession()->cart);
			$this->getMessage()->addMessage('Cart item deleted successfully.');
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $cartBlock
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
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);Ccc::register('cart',$this->getMessage()->getSession()->cart);
			Ccc::register('cart',$this->getMessage()->getSession()->cart);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$cartBlock = Ccc::getBlock('Cart_Grid')->toHtml();
			$response = [
				'status' => 'success',
				'elements' =>[
						[
							'element' => '#indexContent',
							'content' => $cartBlock
						],

						[
							'element' => '#indexMessage',
							'content' => $messageBlock
						]

					]
				];
			$this->renderJson($response);
			// $this->redirect('grid',null,['id'=>null]);	
		}
	}
}