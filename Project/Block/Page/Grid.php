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
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`pageId`) FROM `Page`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$pageRow = Ccc::getModel('Page');
		$startLimit = $this->getPager()->getStartLimit()-1;
		$query = "SELECT * FROM `Page` order by `pageId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$pages =$pageRow-> fetchAll($query);
		if(!$pages)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $pages;
	}
}