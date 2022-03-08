<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Salseman_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salseman/customer/grid.php');
	}

	public function getCustomers()
	{
		return $this->getData('customers');

	}
}