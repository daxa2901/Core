<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Product_Grid extends Block_Core_Grid
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTitle('Product Details');
		parent::__construct();
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

	public function getEditUrl($product)
	{
		return $this->getUrl('edit','product',['id'=>$product->productId]);
	}
	
	public function getDeleteUrl($product)
	{
		return $this->getUrl('delete','product',['id'=>$product->productId]);
	}
	
	public function getMediaUrl($product)
	{
		return $this->getUrl('grid','product_media',['id'=>$product->productId]);
	}
	public function prepareActions()
	{
		$this->addAction([
			'title'=>'Edit',
			'method'=>'getEditUrl',
			],'edit');
		
		$this->addAction([
			'title'=>'Delete',
			'method'=>'getDeleteUrl',
			],'delete');
		$this->addAction([
			'title'=>'Media',
			'method'=>'getMediaUrl',
			],'media');
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getProducts());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('productId',[
			'title'=>'product Id',
			'type'=>'int'
		]);

		$this->addColumn('name',[
			'title'=>'Name',
			'type'=>'varchar'
		]);
		
		$this->addColumn('Sku',[
			'title'=>'sku',
			'type'=>'varchar'
		]);
		
		$this->addColumn('base',[
			'title'=>'Base Image',
			'type'=>'varchar'
		]);
		
		$this->addColumn('thumb',[
			'title'=>'Thumb Image',
			'type'=>'varchar'
		]);
	
		$this->addColumn('small',[
			'title'=>'Small image',
			'type'=>'varchar'
		]);
	
		$this->addColumn('price',[
			'title'=>'Price',
			'type'=>'float'
		]);
		
		$this->addColumn('cost',[
			'title'=>'Cost',
			'type'=>'float'
		]);
		
		$this->addColumn('discount',[
			'title'=>'Discount',
			'type'=>'float'
		]);
		
		$this->addColumn('tax',[
			'title'=>'tax Percentage',
			'type'=>'float'
		]);
		
		$this->addColumn('quantity',[
			'title'=>'Quantity',
			'type'=>'int'
		]);
		
		$this->addColumn('status',[
			'title'=>'Status',
			'type'=>'int'
		]);
	
		$this->addColumn('createdAt',[
			'title'=>'Created Date',
			'type'=>'datetime'
		]);
	
		$this->addColumn('updatedAt',[
			'title'=>'Updated Date',
			'type'=>'datetime'
		]);
	
		return $this;
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
		 		* FROM `product` order by `productId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";

		$products = $productRow-> fetchAll($query);
		if(!$products)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];
		}
		return $products;
	}
}