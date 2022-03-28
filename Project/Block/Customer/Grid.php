<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 
class Block_Customer_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Customer Details');
	}

	public function getEditUrl($customer)
	{
		return $this->getUrl('edit',null,['id'=>$customer->customerId]);
	}
	
	public function getDeleteUrl($customer)
	{
		return $this->getUrl('delete',null,['id'=>$customer->customerId]);
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
		$this->setCollections($this->getCustomers());
		return $this;
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('customerId',[
			'title'=>'customerId',
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
		$this->addColumn('status',[
			'title'=>'Status',
			'type'=>'int'
		]);
	
		$this->addColumn('mobile',[
			'title'=>'Mobile',
			'type'=>'int'
		]);
	
		$this->addColumn('createdDate',[
			'title'=>'Created Date',
			'type'=>'datetime'
		]);
	
		$this->addColumn('updatedDate',[
			'title'=>'Updated Date',
			'type'=>'datetime'
		]);
	
		return $this;
	}

	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`customerId`) FROM `customer`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;	
		$customerRow = Ccc::getModel('Customer');
		$query = "SELECT c.* , a.`address` 
				FROM `Customer` c 
				LEFT JOIN `customer_address` a
			 ON c.`customerId` = a.`customerId` AND type = 'billing' order by `customerId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$customers = $customerRow-> fetchAll($query);
		if(!$customers)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		return $customers;
	}

}