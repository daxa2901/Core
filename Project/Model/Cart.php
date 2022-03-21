<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart extends Model_Core_Row
{
	protected $items = null;
	protected $customer = null;
	protected $shippingAddress = null;
	protected $billingAddress = null;
	protected $shippingMethod = null;
	protected $paymentMethod = null;
	public function __construct()
	{
		$this->setResourceClassName('Cart_Resource');
		parent::__construct();
	}

	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}
	
	public function getItems($reload = false)
	{
		$itemModel = Ccc::getModel('Cart_Item');
		if (!$this->cartId) 
		{
			return $itemModel;
		}	
		if ($this->items && !$reload) 
		{
			return $this->items;
		}
		$query = "SELECT * FROM {$itemModel->getResource()->getTableName()} WHERE cartId = {$this->cartId}";
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
		if (!$this->cartId) 
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

	public function setShippingMethods($shippingMethod)
	{
		$this->shippingMethod = $shippingMethod;
		return $this;
	}
	
	public function getShippingMethods($reload = false)
	{
		$shippingMethodModel = Ccc::getModel('ShippingMethod');
		if (!$this->cartId || !$this->shippingMethodId) 
		{
			return $shippingMethodModel;
		}	
		if ($this->shippingMethod && !$reload) 
		{
			return $this->shippingMethod;
		}
		$query = "SELECT * FROM {$shippingMethodModel->getResource()->getTableName()} WHERE methodId = {$this->shippingMethodId}";
		$shippingMethod = $shippingMethodModel->fetchAll($query);
		if (!$shippingMethod) 
		{
			return $shippingMethodModel;
		}
		$this->setShippingMethod($shippingMethod);
		return $this->shippingMethod;
	}
	
	public function setPaymentMethods($paymentMethod)
	{
		$this->paymentMethod = $paymentMethod;
		return $this;
	}
	
	public function getPaymentMethods($reload = false)
	{
		$paymentMethodModel = Ccc::getModel('PaymentMethod');
		if (!$this->cartId || !$this->paymentMethodId) 
		{
			return $paymentMethodModel;
		}	
		if ($this->paymentMethod && !$reload) 
		{
			return $this->paymentMethod;
		}
		$query = "SELECT * FROM {$paymentMethodModel->getResource()->getTableName()} WHERE methodId = {$this->paymentMethodId}";
		$paymentMethod = $paymentMethodModel->fetchAll($query);
		if (!$paymentMethod) 
		{
			return $paymentMethodModel;
		}
		$this->setPaymentMethod($paymentMethod);
		return $this->paymentMethod;
	}

	public function getBillingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Cart_Address');
		if (!$this->cartId) 
		{
			return $addressModel;
		}	
		if ($this->billingAddress && !$reload) 
		{
			return  $this->billingAddress;
		}
		$query = "SELECT * FROM {$addressModel->getResource()->getTableName()} WHERE cartId = {$this->cartId} AND type = '".get_class($addressModel)::BILLING."'";
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
		$addressModel = Ccc::getModel('Cart_Address');
		if (!$this->cartId) 
		{
			return $addressModel;
		}	
		if ($this->shippingAddress && !$reload) 
		{
			return  $this->shippingAddress;
		}
		$query = "SELECT * FROM {$addressModel->getResource()->getTableName()} WHERE cartId = {$this->cartId} AND type = '".get_class($addressModel)::SHIPPING."'";
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