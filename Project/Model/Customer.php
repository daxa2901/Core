<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer extends Model_Core_Row
{
	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $salseman = null;
	protected $prices = null;
	protected $cart = null;
	protected $orders = null;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
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

	public function getBillingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if (!$this->customerId) 
		{
			return $addressModel;
		}	
		if ($this->billingAddress && !$reload) 
		{
			return  $this->billingAddress;
		}
		$query = "SELECT * FROM {$addressModel->getResource()->getTableName()} WHERE customerId = {$this->customerId} AND type = '".get_class($addressModel)::BILLING."'";
		$address = $addressModel->fetchRow($query);
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setBillingAddress($address);
		return $this->billingAddress;
	}

	public function setBillingAddress($address)
	{
		$this->billingAddress = $address;
		return $this;
	}
	
	public function getShippingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if (!$this->customerId) 
		{
			return $addressModel;
		}	
		if ($this->shippingAddress && !$reload) 
		{
			return  $this->shippingAddress;
		}
		$query = "SELECT * FROM {$addressModel->getResource()->getTableName()} WHERE customerId = {$this->customerId} AND type = '".get_class($addressModel)::SHIPPING."'";
		$address = $addressModel->fetchRow($query);
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setShippingAddress($address);
		return $this->shippingAddress;
	}

	public function setShippingAddress($address)
	{
		$this->shippingAddress = $address;
		return $this;
	}

	public function setSalseman($salseman)
	{
		$this->salseman = $salseman;
		return $this;
	}
	
	public function getSalseman($reload = false)
	{
		$salsemanModel = Ccc::getModel('Salseman');
		if (!$this->customerId) 
		{
			return $salsemanModel;
		}	
		if ($this->salseman && !$reload) 
		{
			return  $this->salseman;
		}
		$query = "SELECT * FROM {$salsemanModel->getResource()->getTableName()} WHERE salsemanId = {$this->salsemanId}";
		$salseman = $salsemanModel->fetchRow($query);
		if (!$salseman) 
		{
			return $salsemanModel;
		}
		$this->setSalseman($salseman);
		return $this->salseman;
	}

	public function setPrices($prices)
	{
		$this->prices = $prices;
		return $this;
	}
	
	public function getPrices($reload = false)
	{
		$priceModel = Ccc::getModel('Customer_Price');
		if (!$this->customerId) 
		{
			return $priceModel;
		}	
		if ($this->prices && !$reload) 
		{
			return  $this->prices;
		}
		$query = "SELECT * FROM {$priceModel->getResource()->getTableName()} WHERE customerId = {$this->customerId}";
		$prices = $priceModel->fetchAll($query);
		if (!$prices) 
		{
			return $priceModel;
		}
		$this->setPrices($prices);
		return $this->prices;
	}
	
	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}
	
	public function getCart($reload = false)
	{
		$cartModel = Ccc::getModel('Cart');
		if (!$this->customerId) 
		{
			return $cartModel;
		}	
		if ($this->cart && !$reload) 
		{
			return  $this->cart;
		}
		$query = "SELECT * FROM {$cartModel->getResource()->getTableName()} WHERE customerId = {$this->customerId}";
		$cart = $cartModel->fetchRow($query);
		if (!$cart) 
		{
			return $cartModel;
		}
		$this->setCart($cart);
		return $this->cart;
	}
	
	public function setOrders($orders)
	{
		$this->orders = $orders;
		return $this;
	}
	
	public function getOrders($reload = false)
	{
		$orderModel = Ccc::getModel('Order');
		if (!$this->customerId) 
		{
			return $orderModel;
		}	
		if ($this->orders && !$reload) 
		{
			return  $this->orders;
		}
		$query = "SELECT * FROM {$orderModel->getResource()->getTableName()} WHERE customerId = {$this->customerId}";
		$orders = $orderModel->fetchAll($query);
		if (!$orders) 
		{
			return $orderModel;
		}
		$this->setOrders($orders);
		return $this->orders;
	}
}