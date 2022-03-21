<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Cart_PaymentMethod_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/paymentMethod/grid.php');
	}

	public function getPaymentMethods()
	{

		$paymentMethod = Ccc::getModel('PaymentMethod');
		$query = "SELECT * FROM `paymentMethod` order by `methodId` desc";
		$paymentMethods =  $paymentMethod-> fetchAll($query);
		return $paymentMethods;
	}

	public function getCart()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		return Ccc::getModel('Cart')->load($cartId);
	}
}