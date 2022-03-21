<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart_Item extends Model_Core_Row
{
	protected $product = null;
	protected $cart = null;
	public function __construct()
	{
		$this->setResourceClassName('Cart_Item_Resource');
		parent::__construct();
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product');
		if (!$this->cartId) 
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

	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getcart($reload = false)
	{
		$cartModel = Ccc::getModel('Cart');
		if (!$this->cartId) 
		{
			return $cartModel;
		}	
		if ($this->cart && !$reload) 
		{
			return $this->cart;
		}
		$query = "SELECT * FROM {$cartModel->getResource()->getTableName()} WHERE cartId = {$this->cartId}";
		$cart = $cartModel->fetchRow($query);
		if (!$cart) 
		{
			return $cartModel;
		}
		$this->setCart($cart);
		return $this->cart;
	}


}