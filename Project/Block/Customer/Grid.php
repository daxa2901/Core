<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomers()
	{
		$customerRow = Ccc::getModel('Customer');
		$query = "SELECT c.* , a.`address` 
				FROM `Customer` c 
				JOIN `customer_address` a
			 ON c.`customerId` = a.`customerId`";
		$customers = $customerRow-> fetchAll($query);
		return $customers;
	}

}