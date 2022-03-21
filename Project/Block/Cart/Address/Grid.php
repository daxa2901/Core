<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Cart_Address_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/address/grid.php');
	}

	public function getBillingAddress()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		$billingAddress = Ccc::getModel('Cart')->load($cartId)->getBillingAddress();
		return $billingAddress;
	}
	
	public function getShippingAddress()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		$shippingAddress = Ccc::getModel('Cart')->load($cartId)->getShippingAddress();
		return $shippingAddress;
	}
}