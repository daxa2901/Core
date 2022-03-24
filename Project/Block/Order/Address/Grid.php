<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Order_Address_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/order/address/grid.php');
	}

	public function getBillingAddress()
	{
		$order = Ccc::getRegistry('order');
		$billingAddress = $order->getBillingAddress();
		return $billingAddress;
	}
	
	public function getShippingAddress()
	{
		$order = Ccc::getRegistry('order');
		$shippingAddress = $order->getShippingAddress();
		return $shippingAddress;
	}
}