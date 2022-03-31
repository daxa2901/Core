<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Page_Grid extends Block_Core_Grid
{
	protected $pager = null;
	public function __construct()
	{
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

	public function getEditUrl($page)
	{
		return $this->getUrl('edit',null,['id'=>$page->pageId]);
	}
	
	public function getDeleteUrl($page)
	{
		return $this->getUrl('delete',null,['id'=>$page->pageId]);
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
		$this->setCollections($this->getPages());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('pageId',[
			'title'=>'Page Id',
			'type'=>'int'
		]);

		$this->addColumn('name',[
			'title'=>'Name',
			'type'=>'varchar'
		]);
		
		$this->addColumn('content',[
			'title'=>'Content',
			'type'=>'varchar'
		]);
		
		$this->addColumn('code',[
			'title'=>'Code',
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
	
		return $this;
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
			$pages = [];
		}
		return $pages;
		
	}
}