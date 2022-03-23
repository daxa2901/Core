<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Order_ShippingMethod_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/order/shippingMethod/grid.php');
	}

	public function getShippingMethod()
	{
		$order = Ccc::getRegistry('order');
		$shippingMethod = $order->getShippingMethod();
		return $shippingMethod;			
	
	}
}