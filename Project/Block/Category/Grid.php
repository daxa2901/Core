<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Category_Grid extends Block_Core_Grid
{
	protected $pager = null;
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Category Details');
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

	public function getEditUrl($category)
	{
		return $this->getUrl('edit',null,['id'=>$category->categoryId]);
	}
	
	public function getDeleteUrl($category)
	{
		return $this->getUrl('delete',null,['id'=>$category->categoryId]);
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
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getCategory());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('categoryId',[
			'title'=>'category Id',
			'type'=>'int'
		]);

		$this->addColumn('name',[
			'title'=>'Name',
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
		 		* 
		 	FROM `category`
				order by `categoryPath` LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";

		$categories = $categoryTable->fetchAll($query);	
		if(!$categories)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];			
		}
		$categoryPath = $this->getCategoryToPath();
		foreach ($categories as $key => $value) {
			$value->name = $categoryPath[$value->categoryId];
		}
		return $categories;
	}
	
	public function getCategoryToPath()
	{
		return Ccc::getModel('Category')->getCategoryToPath();
	}
}