<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Edit_Tabs_Personal extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit/tabs/personal.php');
	}

	public function getCustomer()
	{
		return Ccc::getRegistry('customer');
	}
}