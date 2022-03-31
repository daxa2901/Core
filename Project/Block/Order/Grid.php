<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 

class Block_Order_Grid extends Block_Core_Grid
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
	
	public function getEditUrl($order)
	{
		return $this->getUrl('edit',null,['id'=>$order->orderId]);
	}
	
	public function getDeleteUrl($order)
	{
		return $this->getUrl('delete',null,['id'=>$order->orderId]);
	}
	public function prepareActions()
	{
		$this->addAction([
			'title'=>'View',
			'method'=>'getViewUrl',
			],'edit');
		
		$this->addAction([
			'title'=>'Delete',
			'method'=>'getDeleteUrl',
			],'delete');
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getOrders());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();
		$this->addColumn('orderId',[
			'title'=>'Order Id',
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
	
		$this->addColumn('grandTotal',[
			'title'=>'Grand Total',
			'type'=>'float'
		]);
	
		$this->addColumn('mobile',[
			'title'=>'Mobile',
			'type'=>'int'
		]);
	
		$this->addColumn('shippingCost',[
			'title'=>'Shipping Cost',
			'type'=>'float'
		]);
	
		$this->addColumn('status',[
			'title'=>'Status',
			'type'=>'int'
		]);
	
		$this->addColumn('state',[
			'title'=>'State',
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
	

	public function getOrders()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`orderId`) FROM `orders`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$orderRow = Ccc::getModel('Order');
		$startLimit = $this->getPager()->getStartLimit()-1;
		$query = "SELECT * FROM `orders` order by `orderId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$orders = $orderRow->fetchAll($query);
		if(!$orders)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
			return [];
		}
		return $orders;
		
	}
}