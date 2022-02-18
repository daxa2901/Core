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
			$customerTable = Ccc::getModel('Customer');
			$query2 = "SELECT a.address 
				FROM Customer c 
					JOIN  
				address a ON c.customerId = a.customerId";
			$address = $customerTable-> fetchAll($query2);
			return $address;
		}
}