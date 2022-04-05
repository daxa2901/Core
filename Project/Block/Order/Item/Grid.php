<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Order_Item_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/order/item/grid.php');
	}

	public function getItems()
	{
		$order = Ccc::getRegistry('order');
		$items = $order->getItems();
		return $items;
	}

	public function getOrder()
	{
		return Ccc::getRegistry('order');
	}

	public function getComments()
	{
		return Ccc::getRegistry('order')->getComments();
	}

}