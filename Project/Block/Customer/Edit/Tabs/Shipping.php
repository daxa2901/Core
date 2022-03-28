<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Edit_Tabs_Shipping extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit/tabs/shipping.php');
	}

	public function getShippingAddress()
	{
		$customer =  Ccc::getRegistry('customer');
		return $customer->getShippingAddress();
	}
}