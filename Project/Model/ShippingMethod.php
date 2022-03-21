<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php
class Model_ShippingMethod extends Model_Core_Row
{
	protected $cart = null;
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

	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getcart($reload = false)
	{
		$cartModel = Ccc::getModel('Cart');
		if (!$this->methodId) 
		{
			return $cartModel;
		}	
		if ($this->cart && !$reload) 
		{
			return $this->cart;
		}
		$query = "SELECT * FROM {$cartModel->getResource()->getTableName()} WHERE methodId = {$this->methodId}";
		$cart = $cartModel->fetchAll($query);
		if (!$cart) 
		{
			return $cartModel;
		}
		$this->setCart($cart);
		return $this->cart;
	}

}