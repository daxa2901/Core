<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_PaymentMethod_Edit_Tabs_Method extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/PaymentMethod/edit/tabs/method.php');
	}

	public function getPaymentMethod()
	{
		return Ccc::getRegistry('paymentMethod');
	}
}