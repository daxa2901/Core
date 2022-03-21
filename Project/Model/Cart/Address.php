<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart_Address extends Model_Core_Row
{
	protected $cart = null;
	const BILLING = 'billing';
	const SHIPPING = 'shipping';
	
	public function __construct()
	{
		$this->setResourceClassName('Cart_Address_Resource');
		parent::__construct();
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