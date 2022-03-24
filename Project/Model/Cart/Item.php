<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart_Item extends Model_Core_Row
{
	protected $product = null;
	protected $cart = null;
	const DISCOUNT_FIXED = 2;
	const DISCOUNT_PERCENTAGE = 1;
	const DISCOUNT_DEFAULT = 1;
	const DISCOUNT_PERCENTAGE_LBL = 'Percentage';
	const DISCOUNT_FIXED_LBL = 'Fixed';
	
	public function __construct()
	{
		$this->setResourceClassName('Cart_Item_Resource');
		parent::__construct();
	}
	
	public function getDiscountMode($key = null)
	{
		$discountModes = [
			self::DISCOUNT_FIXED => self::DISCOUNT_FIXED_LBL,
			self::DISCOUNT_PERCENTAGE => self::DISCOUNT_PERCENTAGE_LBL,
		];

		if(!$key)
		{
			return $discountModes;
		}

		if (array_key_exists($key,$discountModes)) 
		{	
			return $discountModes[$key];
		}
		return self::DISCOUNT_DEFAULT;
	}


	public function getFinalPrice()
	{
		if (!$this->itemId) 
		{
			return null;
		}
		$product = $this->getProduct();
		$discount = $this->discount;
		if ($this->discountMode == self::DISCOUNT_PERCENTAGE) 
		{
			$discount = ($product->price * ($this->discount/100));
		}
		$finalPrice = $product->price - $discount;
		if ($finalPrice < $this->cost) 
		{
			$this->discount = $this->getProduct()->discount;
			return $this;
		}
		return $finalPrice;
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
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

	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getcart($reload = false)
	{
		$cartModel = Ccc::getModel('Cart');
		if (!$this->itemId) 
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