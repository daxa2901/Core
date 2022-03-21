<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Cart_ShippingMethod_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/shippingMethod/grid.php');
	}

	public function getShippingMethods()
	{
		$shippingMethod = Ccc::getModel('shippingMethod');
		$query = "SELECT * FROM `shippingMethod` order by `methodId` desc";
		$shippingMethods =  $shippingMethod-> fetchAll($query);
		return $shippingMethods;
			
	}

	public function getCart()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		return Ccc::getModel('Cart')->load($cartId);
	}
}