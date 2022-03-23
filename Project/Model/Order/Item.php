<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Order_Item extends Model_Core_Row
{
	protected $product = null;
	protected $order = null;
	public function __construct()
	{
		$this->setResourceClassName('Order_Item_Resource');
		parent::__construct();
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}

	public function getFinalPrice()
	{
		$product = $this->getProduct();
		$discount = $this->discount;
		if ($product->discountMode == get_class($product)::DISCOUNT_PERCENTAGE) 
		{
			$discount = ($this->price * ($this->discount/100));
		}
		
		return $this->price - $discount;
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product');
		if (!$this->itemId) 
		{
			return $productModel;
		}	
		if ($this->product && !$reload) 
		{
			return $this->product;
		}
		$query = "SELECT * FROM {$productModel->getResource()->getTableName()} WHERE productId = {$this->productId}";
		$product = $productModel->fetchRow($query);
		if (!$product) 
		{
			return $productModel;
		}
		$this->setProduct($product);
		return $this->product;
	}

	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}

	public function getOrder($reload = false)
	{
		$orderModel = Ccc::getModel('Order');
		if (!$this->itemId) 
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