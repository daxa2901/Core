<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_Grid extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/cart/grid.php');
	}
	
	public function getCustomer()
	{
		$this->addChild(Ccc::getBlock('Cart_Customer_Grid'),'customer');
		return $this->getChild('customer');
	}
	
	public function getAddress()
	{
		$this->addChild(Ccc::getBlock('Cart_Address_Grid'),'address');
		return $this->getChild('address');
	}

	public function getShippingMethods()
	{
		$this->addChild(Ccc::getBlock('Cart_ShippingMethod_Grid'),'shippingMethod');
		return $this->getChild('shippingMethod');
	}

	public function getPaymentMethods()
	{
		$this->addChild(Ccc::getBlock('Cart_PaymentMethod_Grid'),'paymentMethod');
		return $this->getChild('paymentMethod');
	}
	
	public function getItems()
	{
		$this->addChild(Ccc::getBlock('Cart_Item_Grid'),'items');
		return $this->getChild('items');
	}

	public function getCarts()
	{
		if ($this->cart) 
		{
			$cartId = Ccc::getModel('Admin_Session')->cart;
			$carts = Ccc::getModel('Cart')->load($cartId);
			$cart['cart'] = $carts;
			return $cart;
		}
		else
		{
			$customerRow = Ccc::getModel('Customer');
			$query = "SELECT * FROM `Customer` WHERE status = 1"; 
			$customers['customers'] = $customerRow-> fetchAll($query);
			return $customers;
		}
	}
}