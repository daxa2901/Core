<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Order_Edit extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/order/edit.php');
	}

	public function getOrder()
	{
		return $this->order;
	}
}