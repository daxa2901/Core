<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer_Address extends Model_Core_Row
{
	const BILLING = 'billing';
	const SHIPPING = 'shipping';
	protected $customer= null;
	public function __construct()
	{
		$this->setResourceClassName('Customer_Address_Resource');
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
		if (!$this->addressId) 
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
		$this->setCustomer($customer);
		return $this->customer;
	}
}