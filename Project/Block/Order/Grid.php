<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Order_Grid extends Block_Core_Template
{
	protected $pager = null;	

	public function __construct()
	{
		$this->setTemplate('view/order/grid.php');
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}

	public function getOrders()
	{
		$model = Ccc::getModel('Order');
		$query = "SELECT * FROM `orders` order by `orderId` desc ";
		$orders = $model->fetchAll($query);
		return $orders;
		
	}
}