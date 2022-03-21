<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
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
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`customerId`) FROM `customer`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$customerRow = Ccc::getModel('Customer');
		$query = "SELECT c.* , a.`address` 
				FROM `Customer` c 
				JOIN `customer_address` a
			 ON c.`customerId` = a.`customerId` AND type = 'billing' order by `customerId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$customers = $customerRow-> fetchAll($query);
		if(!$customers)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $customers;
	}

}