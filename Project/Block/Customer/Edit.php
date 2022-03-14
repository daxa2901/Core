<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit.php');
	}

	public function getCustomer()
	{
		return $this->customer;
	}

	public function getAddress()
	{
		return $this->address;
	}
}