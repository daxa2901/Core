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
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`orderId`) FROM `orders`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$orderRow = Ccc::getModel('Order');
		$startLimit = $this->getPager()->getStartLimit()-1;
		$query = "SELECT * FROM `orders` order by `orderId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$orders = $orderRow->fetchAll($query);
		if(!$orders)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $orders;
		
	}
}