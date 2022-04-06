<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Config_Grid extends Block_Core_Grid
{
	protected $pager = null;
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Config Details');
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

	public function getEditUrl($config)
	{
		return $this->getUrl('edit',null,['id'=>$config->configId]);
	}
	
	public function getDeleteUrl($config)
	{
		return $this->getUrl('delete',null,['id'=>$config->configId]);
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
		$this->setCollections($this->getConfigs());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('configId',[
			'title'=>'config Id',
			'type'=>'int'
		]);

		$this->addColumn('name',[
			'title'=>'Name',
			'type'=>'varchar'
		]);
		
		$this->addColumn('code',[
			'title'=>'Code',
			'type'=>'varchar'
		]);
		
		$this->addColumn('value',[
			'title'=>'value',
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
	
	public function getConfigs()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`configId`) FROM `config`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$configRow = Ccc::getModel('Config');
		$query = "SELECT * FROM `config` order by `configId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$configs = $configRow-> fetchAll($query);
		if(!$configs)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];
		}
		return $configs;
	}
}