<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Order extends Model_Core_Row
{
	protected $items = null;
	protected $customer = null;
	protected $shippingAddress = null;
	protected $billingAddress = null;
	protected $shippingMethod = null;
	protected $paymentMethod = null;
	const STATUS_PENDING = 1;
	const STATUS_PACKAGING = 2;
	const STATUS_SHIPPED = 3;
	const STATUS_DELIVERY = 4;
	const STATUS_DISPATCHED = 5;
	const STATUS_COMPLETED = 6;
	const STATUS_PENDING_LBL = 'Pending';
	const STATUS_PACKAGING_LBL = 'Packaging';
	const STATUS_SHIPPED_LBL = 'Shipped';
	const STATUS_DELIVERY_LBL = 'Out for delivery';
	const STATUS_DISPATCHED_LBL = 'Dispatched';
	const STATUS_COMPLETED_LBL = 'Completed';
	
	const STATE_PENDING = 1;
	const STATE_PROCESSING = 2;
	const STATE_COMPLETED = 3;
	const STATE_CANCELLED = 4;
	const STATE_PENDING_LBL = 'Pending';
	const STATE_PROCESSING_LBL = 'Processing';
	const STATE_COMPLETED_LBL = 'Completed';
	const STATE_CANCELLED_LBL = 'Cancelled';

	public function __construct()
	{
		$this->setResourceClassName('Order_Resource');
		parent::__construct();
	}
	
	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_PENDING => self::STATUS_PENDING_LBL,
			self::STATUS_PACKAGING => self::STATUS_PACKAGING_LBL,
			self::STATUS_SHIPPED => self::STATUS_SHIPPED_LBL,
			self::STATUS_DELIVERY => self::STATUS_DELIVERY_LBL,
			self::STATUS_DISPATCHED => self::STATUS_DISPATCHED_LBL,
			self::STATUS_COMPLETED => self::STATUS_COMPLETED_LBL,
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

	public function getState($key = null)
	{
		$states = [
			self::STATE_PENDING => self::STATE_PENDING_LBL,
			self::STATE_PROCESSING => self::STATE_PROCESSING_LBL,
			self::STATE_COMPLETED => self::STATE_COMPLETED_LBL,
			self::STATE_CANCELLED => self::STATE_CANCELLED_LBL,
		];

		if(!$key)
		{
			return $states;
		}

		if (array_key_exists($key,$states)) 
		{	
			return $states[$key];
		}
		return self::STATUS_DEFAULT;
	}


	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}
	
	public function getItems($reload = false)
	{
		$itemModel = Ccc::getModel('Order_Item');
		if (!$this->orderId) 
		{
			return $itemModel;
		}	
		if ($this->items && !$reload) 
		{
			return $this->items;
		}
		$query = "SELECT * FROM {$itemModel->getResource()->getTableName()} WHERE orderId = {$this->orderId}";
		$items = $itemModel->fetchAll($query);
		if (!$items) 
		{
			return $itemModel;
		}
		$this->setItems($items);
		return $this->items;
	}

	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}
	
	public function getcustomer($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if (!$this->orderId) 
		{
			return $customerModel;
		}	
		if ($this->customer && !$reload) 
		{
			return $this->customer;
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

	public function setShippingMethod($shippingMethod)
	{
		$this->shippingMethod = $shippingMethod;
		return $this;
	}
	
	public function getShippingMethod($reload = false)
	{
		$shippingMethodModel = Ccc::getModel('ShippingMethod');
		if (!$this->orderId || !$this->shippingMethodId) 
		{
			return $shippingMethodModel;
		}	
		if ($this->shippingMethod && !$reload) 
		{
			return $this->shippingMethod;
		}
		$query = "SELECT * FROM {$shippingMethodModel->getResource()->getTableName()} WHERE methodId = {$this->shippingMethodId}";
		$shippingMethod = $shippingMethodModel->fetchRow($query);
		if (!$shippingMethod) 
		{
			return $shippingMethodModel;
		}
		$this->setShippingMethod($shippingMethod);
		return $this->shippingMethod;
	}
	
	public function setPaymentMethod($paymentMethod)
	{
		$this->paymentMethod = $paymentMethod;
		return $this;
	}
	
	public function getPaymentMethod($reload = false)
	{
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		if (!$this->orderId || !$this->paymentMethodId) 
		{
			return $paymentMethodModel;
		}	
		if ($this->paymentMethod && !$reload) 
		{
			return $this->paymentMethod;
		}
		$query = "SELECT * FROM {$paymentMethodModel->getResource()->getTableName()} WHERE methodId = {$this->paymentMethodId}";
		$paymentMethod = $paymentMethodModel->fetchRow($query);
		if (!$paymentMethod) 
		{
			return $paymentMethodModel;
		}
		$this->setPaymentMethod($paymentMethod);
		return $this->paymentMethod;
	}

	public function getBillingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Order_Address');
		if (!$this->orderId) 
		{
			return $addressModel;
		}	
		if ($this->billingAddress && !$reload) 
		{
			return  $this->billingAddress;
		}
		$query = "SELECT * FROM {$addressModel->getResource()->getTableName()} WHERE orderId = {$this->orderId} AND type = '".get_class($addressModel)::BILLING."'";
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
		$addressModel = Ccc::getModel('Order_Address');
		if (!$this->orderId) 
		{
			return $addressModel;
		}	
		if ($this->shippingAddress && !$reload) 
		{
			return  $this->shippingAddress;
		}
		$query = "SELECT * FROM {$addressModel->getResource()->getTableName()} WHERE orderId = {$this->orderId} AND type = '".get_class($addressModel)::SHIPPING."'";
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

	
}