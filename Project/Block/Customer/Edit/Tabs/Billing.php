<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Edit_Tabs_Billing extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit/tabs/billing.php');
	}

	public function getBillingAddress()
	{
		$customer =  Ccc::getRegistry('customer');
		return $customer->getBillingAddress();
	}
}