<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Order extends Controller_Admin_Action
{
	
	public function gridAction()
	{	
		unset(Ccc::getModel('Admin_Session')->cart);
		$this->setPageTitle('Order Grid');
		$content = $this->getLayout()->getContent();
		$order = Ccc::getBlock('Order_Grid');
		$content->addChild($order);
		$this->renderLayout();
	}

	
	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Order Save');
			if (!$this->getRequest()->isPost() || ! $this->getRequest()->getRequest('grandTotal')) 
			{
				throw new Exception("Invalid request.", 1);
			}
			$cartId = Ccc::getModel('Admin_Session')->cart;
			$cart = Ccc::getModel('Cart')->load($cartId);
			if (!$cart->cartId) 
			{
				throw new Exception("record not found.", 1);
			}
			
			$items = $cart->getItems();
			$shippingMethod = $cart->getShippingMethod();
			$paymentMethod = $cart->getPaymentMethod();
			$billingAddress = $cart->getBillingAddress();
			$shippingAddress = $cart->getShippingAddress();
			$customer = $cart->getCustomer();
			if (!$shippingMethod->methodId || !$paymentMethod->methodId || !$billingAddress->addressId || !$shippingAddress->addressId || !$customer->customerId || !array_key_exists('0',$items)) 
			{
				throw new Exception("Enter full details.", 1);
			}

			$order = Ccc::getModel('Order');
			$order->customerId = $customer->customerId;
			$order->firstName = $customer->firstName;
			$order->lastName = $customer->lastName;
			$order->email = $customer->email;
			$order->mobile = $customer->mobile;
			$order->shippingMethodId = $cart->shippingMethodId;
			$order->paymentMethodId = $cart->paymentMethodId;
			$order->shippingCost = $cart->shippingCost;
			$order->createdAt = date('Y-m-d H:i:s');
			$order->grandTotal = $this->getRequest()->getPost()['grandTotal'];
			$order = $order->save();
			if (!$order) 
			{
				throw new Exception("System is unable to insert.", 1);
			}
			$tax = 0;
			foreach ($items as $key => $value) 
			{
				$product = $value->getProduct();
				$item = Ccc::getModel('Order_Item');
				$item->setData($value->getData());
				unset($item->itemId);
				unset($item->cartId);
				$item->orderId = $order->orderId;
				$item->name =$product->name; 
				$item->sku =$product->sku; 
				$item->price =$product->price; 
				$item->createdAt = date('Y-m-d H:i:s'); 
				unset($item->updatedAt);
				$item = $item->save();
				if (!$item) 
				{
					throw new Exception("System is unable to insert.", 1);
				}
				$tax = $tax + $value->taxAmount;
				$value = $value->delete();
				if (!$value) 
				{
					throw new Exception("System is unable to delete.", 1);
					
				}
			}
			$order->taxAmount = $tax;
			$order = $order->save();
			if (!$order) 
			{
				throw new Exception("System is unable to insert.", 1);
			}
			

			$orderBilling = $order->getBillingAddress();
			$orderBilling->setData($billingAddress->getData());
			$orderBilling->createdAt = date('Y-m-d H:i:s');
			$orderBilling->orderId = $order->orderId;
			unset($orderBilling->addressId);
			unset($orderBilling->cartId);
			unset($orderBilling->same);
			unset($orderBilling->updatedAt);
			$orderBilling = $orderBilling->save();
			if (!$orderBilling) 
			{
				throw new Exception("System is unable to insert.", 1);
			}

			$orderShipping = $order->getShippingAddress();
			$orderShipping->setData($shippingAddress->getData());
			$orderShipping->createdAt = date('Y-m-d H:i:s');
			$orderShipping->orderId = $order->orderId;
			unset($orderShipping->addressId);
			unset($orderShipping->same);
			unset($orderShipping->cartId);
			unset($orderShipping->updatedAt);
			$orderShipping = $orderShipping->save();
			if (!$orderShipping) 
			{
				throw new Exception("System is unable to insert.", 1);
			}
			
			$cart->subTotal = 0;
			$cart = $cart->save();
			if (!$cart) 
			{
				throw new Exception("System is unable to update.", 1);
			}
			
			$this->getMessage()->addMessage('Order placed successfully.');
			$this->redirect('grid');
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid');
		}
	}

	public function editAction()
	{
		$this->setPageTitle('View Orders');
		$id=(int)$this->getRequest()->getRequest('id');
  		if (!$id) 
  		{
  			throw new Exception("Invalid Id.", 1);
  		}
		$order = Ccc::getModel('Order')->load($id);
		if (!$order) 
  		{
  			throw new Exception("Unable to Load Config.", 1);
  		}
  		$content = $this->getLayout()->getContent();
  		Ccc::register('order',$order);
		$order = Ccc::getBlock('Order_View')->setdata(['order'=>$order]);
		$content->addChild($order);
		$this->renderLayout();
  		
	}
}