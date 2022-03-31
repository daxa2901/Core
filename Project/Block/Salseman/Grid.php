<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 

class Block_Salseman_Grid extends Block_Core_Grid
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

	public function getEditUrl($salseman)
	{
		return $this->getUrl('edit',null,['id'=>$salseman->salsemanId]);
	}
	
	public function getDeleteUrl($salseman)
	{
		return $this->getUrl('delete',null,['id'=>$salseman->salsemanId]);
	}
	
	public function getcustomerUrl($salseman)
	{
		return $this->getUrl('grid','salseman_customer',['id'=>$salseman->salsemanId,'p'=>1]);
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
			'title'=>'Manage Customer',
			'method'=>'getCustomerUrl',
			],'customer');
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getSalsemans());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('salsemanId',[
			'title'=>'Salseman Id',
			'type'=>'int'
		]);

		$this->addColumn('firstName',[
			'title'=>'First Name',
			'type'=>'varchar'
		]);
		
		$this->addColumn('lastName',[
			'title'=>'Last Name',
			'type'=>'varchar'
		]);
		
		$this->addColumn('email',[
			'title'=>'Email',
			'type'=>'varchar'
		]);
	
		$this->addColumn('status',[
			'title'=>'Status',
			'type'=>'int'
		]);
	
		$this->addColumn('mobile',[
			'title'=>'Mobile',
			'type'=>'int'
		]);
	
		$this->addColumn('percentage',[
			'title'=>'Percentage',
			'type'=>'float'
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
	
	public function getSalsemans()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`salsemanId`) FROM `salseman`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$model = Ccc::getModel('Salseman');
		$query = "SELECT * FROM `salseman` order by `salsemanId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$salsemans = $model->fetchAll($query);
		if(!$salsemans)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];
		}
		return $salsemans;
		
	}
}