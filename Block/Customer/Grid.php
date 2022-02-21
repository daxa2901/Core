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
		$customerTable = Ccc::getModel('Customer');
		$query = "SELECT * FROM Customer";
		$customer = $customerTable-> fetchAll($query);
		return $customer;
	}

	public function getAddress()
	{
		$addressTable = Ccc::getModel('Customer_Address');
		$query2 = "SELECT 
					* 
			  FROM  address";
		$address = $addressTable-> fetchAll($query2);
		return $address;
	}
}