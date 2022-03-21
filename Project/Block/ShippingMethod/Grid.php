<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_ShippingMethod_Grid extends Block_Core_Template
{
	protected $pager = null;	

	public function __construct()
	{
		$this->setTemplate('view/shippingMethod/grid.php');
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
	
	public function getShippingMethods()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`methodId`) FROM `shippingMethod`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$model = Ccc::getModel('ShippingMethod');
		$query = "SELECT * FROM `shippingMethod`LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$shippingMethods = $model->fetchAll($query);
		if(!$shippingMethods)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $shippingMethods;
		
	}
}