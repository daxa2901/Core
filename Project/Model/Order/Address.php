<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Order_Address extends Model_Core_Row
{
	protected $order = null;
	const BILLING = 'billing';
	const SHIPPING = 'shipping';
	
	public function __construct()
	{
		$this->setResourceClassName('Order_Address_Resource');
		parent::__construct();
	}

	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}

	public function getOrder($reload = false)
	{
		$orderModel = Ccc::getModel('order');
		if (!$this->addressId) 
		{
			return $orderModel;
		}	
		if ($this->order && !$reload) 
		{
			return $this->order;
		}
		$query = "SELECT * FROM {$orderModel->getResource()->getTableName()} WHERE orderId = {$this->orderId}";
		$order = $orderModel->fetchRow($query);
		if (!$order) 
		{
			return $orderModel;
		}
		$this->setOrder($order);
		return $this->order;
	}

}