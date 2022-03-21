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
		$id = $this->id;
		$customers = Ccc::getModel('Customer');
		$query = "SELECT 
					* 
					FROM `customer` 
				WHERE `salsemanId` = {$id} OR `salsemanId` IS NULL AND `status` = 1";
		$customers =  $customers->fetchAll($query);
		return $customers;
	}
}