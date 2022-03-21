<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Cart_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/customer/grid.php');
	}

	public function getCustomer()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		$customer = Ccc::getModel('Cart')->load($cartId)->getCustomer();
		return $customer;
	}
}