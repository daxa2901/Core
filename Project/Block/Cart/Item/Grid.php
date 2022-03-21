<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Cart_Item_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/item/grid.php');
	}

	public function getItems()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		$items = Ccc::getModel('Cart')->load($cartId)->getItems();
		return $items;
	}

	public function getProducts()
	{
		$cartId = Ccc::getModel('Admin_Session')->cart;
		$items = Ccc::getModel('Cart')->load($cartId)->getItems();
		$productRow = Ccc::getModel('Product');
		$productIds = [];
		foreach ($items as $key => $value) 
		{
			$productIds[] =$value->productId ;  
		}
		
		if (!$productIds) 
		{
			$query = "SELECT * FROM `product` WHERE `productId`";  
		}
		else
		{
			$productIds = implode(',', $productIds);
			$query = "SELECT * FROM `product` WHERE `productId` NOT IN ({$productIds})";  
		}
		$products = $productRow->fetchAll($query);
		return $products;
	}
}