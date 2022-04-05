<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Vendor_Grid extends Block_Core_Grid
{
	protected $pager = null;
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Vendor Details');
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

	public function getEditUrl($vendor)
	{
		return $this->getUrl('edit',null,['id'=>$vendor->vendorId]);
	}
	
	public function getDeleteUrl($vendor)
	{
		return $this->getUrl('delete',null,['id'=>$vendor->vendorId]);
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
		$this->setCollections($this->getVendors());
		return $this;
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('vendorId',[
			'title'=>'vendorId',
			'type'=>'int'
		]);
		
		$this->addColumn('firstName',[
			'title'=>'firstName',
			'type'=>'varchar'
		]);
		
		$this->addColumn('lastName',[
			'title'=>'lastName',
			'type'=>'varchar'
		]);
		
		$this->addColumn('address',[
			'title'=>'Address',
			'type'=>'varchar'
		]);
		$this->addColumn('email',[
			'title'=>'Email',
			'type'=>'varchar'
		]);
		
		$this->addColumn('mobile',[
				'title'=>'Mobile',
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

	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`vendorId`) FROM `Vendor`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$vendorRow = Ccc::getModel('Vendor');
		$query = "SELECT v.*, a.`address` 
		FROM `Vendor` v LEFT JOIN `vendor_address` a ON v.`vendorId` = a.`vendorId` order by v.`vendorId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$vendors = $vendorRow->fetchAll($query);
		if(!$vendors)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];
		}
		return $vendors;
	}

}