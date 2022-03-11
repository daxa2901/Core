<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php 
class Block_Page_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
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

	public function getPages()
	{
		$request = Ccc::getModel('Core_Request');
		$page = $request->getRequest('p',1);
		$pager = $this->getPager();
		$query = "SELECT count(`pageId`) FROM `Page`";
		$totalCount = $this->getAdapter()->fetchOne($query);

		$pager->execute($totalCount,$page);
		$pageRow = Ccc::getModel('Page');
		$startLimit = $this->getPager()->getStartLimit()-1;
		$query = "SELECT * FROM `Page` LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$pages =$pageRow-> fetchAll($query);
		if(!$pages)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $pages;
	}
}