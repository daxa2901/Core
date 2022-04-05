<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Order_Comment extends Model_Core_Row
{
	protected $order = null;
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
	const STATUS_DEFAULT = 1;
	
	public function __construct()
	{
		$this->setResourceClassName('Order_Comment_Resource');
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
	
	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}

	public function getOrder($reload = false)
	{
		$orderModel = Ccc::getModel('order');
		if (!$this->commentId) 
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