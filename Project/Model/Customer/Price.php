<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer_Price extends Model_Core_Row
{
	protected $customer = null;
	public function __construct()
	{
		$this->setResourceClassName('Customer_Price_Resource');
		parent::__construct();
	}

	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if (!$this->entityId) 
		{
			return $customerModel;
		}	
		if ($this->customer && !$reload) 
		{
			return  $this->customer;
		}
		$query = "SELECT * FROM {$customerModel->getResource()->getTableName()} WHERE customerId = {$this->customerId}";
		$customer = $customerModel->fetchRow($query);
		if (!$customer) 
		{
			return $customerModel;
		}
		$this->setCustomers($customer);
		return $this->customer;
	}
}