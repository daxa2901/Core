<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 

class Block_ShippingMethod_Grid extends Block_Core_Grid
{
	protected $pager = null;	

	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Shipping Details');
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


	public function getEditUrl($shipping)
	{
		return $this->getUrl('edit',null,['id'=>$shipping->methodId]);
	}
	
	public function getDeleteUrl($shipping)
	{
		return $this->getUrl('delete',null,['id'=>$shipping->methodId]);
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
		$this->setCollections($this->getShippingMethods());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('methodId',[
			'title'=>'Method Id',
			'type'=>'int'
		]);

		$this->addColumn('name',[
			'title'=>'Name',
			'type'=>'varchar'
		]);
		
		$this->addColumn('note',[
			'title'=>'Note',
			'type'=>'varchar'
		]);
		
		$this->addColumn('amount',[
			'title'=>'Shipping Amount',
			'type'=>'float'
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
	public function getShippingMethods()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`methodId`) FROM `shippingMethod`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$model = Ccc::getModel('ShippingMethod');
		$query = "SELECT * FROM `shippingMethod`LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$shippingMethods = $model->fetchAll($query);
		if(!$shippingMethods)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $shippingMethods;
		
	}
}