<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Product_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
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

	public function getProducts()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`productId`) FROM `product`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$productRow = Ccc::getModel('Product');
		$query = "SELECT 
		 		c.*,b.`media` as baseImage, t.`media` as thumbImage,s.`media` as smallImage
			FROM `product` c 
			LEFT JOIN `product_media` b 
				ON c.`productId` = b.`productId` AND (c.`base`= b.`mediaId`)
			LEFT JOIN `product_media` t 
				ON c.`productId` = t.`productId` AND (c.`thumb` = t.`mediaId`)
			LEFT JOIN `product_media` s 
				ON c.`productId` = s.`productId` AND (c.`small` = s.`mediaId`) LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";

		$products = $productRow-> fetchAll($query);
		if(!$products)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $products;
	}
}