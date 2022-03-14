<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
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

	public function getCategory()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`categoryId`) FROM `category`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$categoryTable = Ccc::getModel('Category');
		$query = "SELECT 
		 		c.*,b.`media` as baseImage, t.`media` as thumbImage,s.`media` as smallImage
			FROM `Category` c 
			LEFT JOIN `category_media` b 
				ON c.`categoryId` = b.`categoryId` AND (c.`base` = b.`mediaId`)
			LEFT JOIN category_media t 
				ON c.`categoryId` = t.`categoryId` AND (c.`thumb` = t.`mediaId`)
			LEFT JOIN `category_media` s 
				ON c.`categoryId` = s.`categoryId` AND (c.`small` = s.`mediaId`)
		order by c.categoryPath LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";

		$categories = $categoryTable->fetchAll($query);	
		if(!$categories)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $categories;
	}
	
	public function getCategoryToPath()
	{
		return Ccc::getModel('Category')->getCategoryToPath();
	}
}