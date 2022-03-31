<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 

class Block_paymentMethod_Grid extends Block_Core_Grid
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
		$this->setCollections($this->getPaymentMethods());
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
	public function getPaymentMethods()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`methodId`) FROM `paymentMethod`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$model = Ccc::getModel('PaymentMethod');
		$query = "SELECT * FROM `paymentMethod`LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$paymentMethods = $model->fetchAll($query);
		if(!$paymentMethods)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];
		}
		return $paymentMethods;
		
	}
}