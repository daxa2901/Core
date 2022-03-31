<?php Ccc::loadClass('Block_Core_Edit'); ?>

<?php 
class Block_PaymentMethod_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('view/paymentMethod/edit.php');
	}

	// public function getPaymentMethod()
	// {
	// 	return $this->paymentMethod;
	// }
}