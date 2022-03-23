<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Order_PaymentMethod_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/order/paymentMethod/grid.php');
	}

	public function getPaymentMethod()
	{
		$order = Ccc::getRegistry('order');
		$paymentMethod = $order->getPaymentMethod();
		return $paymentMethod;
	}

}