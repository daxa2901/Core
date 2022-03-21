<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Admin_Grid extends Block_Core_Template
{
	protected $pager = null;
	
	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
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

	public function getAdmins()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`adminId`) FROM `admin`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$admins = Ccc::getModel('Admin');
		$query = "SELECT * FROM `Admin` order by `adminId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$admins =  $admins-> fetchAll($query);
		if(!$admins)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $admins;
	}
}