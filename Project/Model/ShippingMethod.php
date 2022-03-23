<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php
class Model_ShippingMethod extends Model_Core_Row
{
	protected $carts = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('ShippingMethod_Resource');
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

	public function setCarts($carts)
	{
		$this->carts = $carts;
		return $this;
	}

	public function getcarts($reload = false)
	{
		$cartModel = Ccc::getModel('Carts');
		if (!$this->methodId) 
		{
			return $cartModel;
		}	
		if ($this->carts && !$reload) 
		{
			return $this->carts;
		}
		$query = "SELECT * FROM {$cartModel->getResource()->getTableName()} WHERE methodId = {$this->methodId}";
		$carts = $cartModel->fetchAll($query);
		if (!$carts) 
		{
			return $cartModel;
		}
		$this->setCarts($carts);
		return $this->carts;
	}

	public function setOrders($orders)
	{
		$this->orders = $orders;
		return $this;
	}
	
	public function getOrders($reload = false)
	{
		$orderModel = Ccc::getModel('Order');
		if (!$this->methodId) 
		{
			return $orderModel;
		}	
		if ($this->orders && !$reload) 
		{
			return  $this->orders;
		}
		$query = "SELECT * FROM {$orderModel->getResource()->getTableName()} WHERE methodId = {$this->methodId}";
		$orders = $orderModel->fetchAll($query);
		if (!$orders) 
		{
			return $orderModel;
		}
		$this->setOrders($orders);
		return $this->orders;
	}

}