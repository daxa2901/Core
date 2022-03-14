<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Vendor_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
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

	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`vendorId`) FROM `Vendor`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$vendorRow = Ccc::getModel('Vendor');
		$query = "SELECT v.*, a.`address` 
		FROM `Vendor` v JOIN `vendor_address` a ON v.`vendorId` = a.`vendorId` LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$vendors = $vendorRow->fetchAll($query);
		if(!$vendors)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $vendors;
	}

}