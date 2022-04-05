<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Order_View extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/order/view.php');
	}

	public function getOrder()
	{
		return Ccc::getRegistry('order');
	}

	public function getAddress()
	{
		$this->addChild(Ccc::getBlock('Order_Address_Grid'),'address');
		return $this->getChild('address');
	}

	public function getItems()
	{
		$this->addChild(Ccc::getBlock('Order_Item_Grid'),'itema');
		return $this->getChild('itema');
	}

	public function getShippingMethod()
	{
		$this->addChild(Ccc::getBlock('Order_ShippingMethod_Grid'),'shippingMethod');
		return $this->getChild('shippingMethod');
	}

	public function getPaymentMethod()
	{
		$this->addChild(Ccc::getBlock('Order_PaymentMethod_Grid'),'paymentMethod');
		return $this->getChild('paymentMethod');
	}

	public function getComments()
	{
		return Ccc::getRegistry('order')->getComments();
	}
}