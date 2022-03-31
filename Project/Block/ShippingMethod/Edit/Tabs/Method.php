<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_ShippingMethod_Edit_Tabs_Method extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/shippingMethod/edit/tabs/method.php');
	}

	public function getShippingMethod()
	{
		return Ccc::getRegistry('shippingMethod');
	}
}