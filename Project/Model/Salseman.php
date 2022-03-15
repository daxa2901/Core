<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php
class Model_Salseman extends Model_Core_Row
{
	protected $customers = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Salseman_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL,
		];

		if(!$key)
		{
			return $statuses;
		}

		if (array_key_exists($key,$statuses)) 
		{	
			return $statuses[$key];
		}
		return self::STATUS_DEFAULT;
	}

	public function setCustomers($customers)
	{
		$this->customers = $customers;
		return $this;
	}

	public function getCustomers($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if (!$this->salsemanId) 
		{
			return $customerModel;
		}	
		if ($this->customers && !$reload) 
		{
			return  $this->customers;
		}
		$query = "SELECT * FROM {$customerModel->getResource()->getTableName()} WHERE salsemanId = {$this->salsemanId}";
		$customers = $customerModel->fetchAll($query);
		if (!$customers) 
		{
			return $customerModel;
		}
		$this->setCustomers($customers);
		return $this->customers;
	}
}