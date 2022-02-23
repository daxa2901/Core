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
		$query = "SELECT * FROM Customer";
		$customer = $customerRow-> fetchAll($query);
		return $customer;
	}

	public function getAddress()
	{
		$addressRow = Ccc::getModel('Customer_Address');
		$query2 = "SELECT 
					* 
			  FROM  customer_address";
		$address = $addressRow-> fetchAll($query2);
		return $address;
	}
}