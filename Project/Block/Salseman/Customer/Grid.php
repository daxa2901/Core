<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Salseman_Customer_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/salseman/customer/grid.php');
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

	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $this->id;
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`customerId`) FROM `customer` WHERE `salsemanId` = {$id} OR `salsemanId` IS NULL";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$customers = Ccc::getModel('Customer');
		$query = "SELECT 
					* 
					FROM `customer` 
				WHERE `salsemanId` = {$id} OR `salsemanId` IS NULL LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$customers =  $customers->fetchAll($query);
		if(!$customers)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $customers;
			

	}
}