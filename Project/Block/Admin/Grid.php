<?php Ccc::loadClass('Block_Core_Grid_Collection'); ?>

<?php 
class Block_Admin_Grid extends Block_Core_Grid_Collection
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Admin Details');
	}

	public function getEditUrl($admin)
	{
		return $this->getUrl('edit',null,['id'=>$admin->adminId]);
	}
	
	public function getDeleteUrl($admin)
	{
		return $this->getUrl('delete',null,['id'=>$admin->adminId]);
	}
	public function prepareActions()
	{
		$this->addAction([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			],'actions');
		return $this;
	}

	public function prepareCollections()
	{
		$this->addCollection([
			$this->getAdmins()
		],'collection');
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'AdminId','First Name', 'Last Name'
		],'columns');
	}
	
	public function getAdmins()
	{
		$request = Ccc::getModel('Core_Request');
		$page = ($page = (int)$request->getRequest('p',1))? $page : 1;
		$pageCount = ($pageCount = (int)$request->getRequest('ppc',10)) ?$pageCount : 10;
		$query = "SELECT count(`adminId`) FROM `admin`";
		$totalCount = $this->getAdapter()->fetchOne($query);
		$this->getPager()->execute($totalCount,$page,$pageCount);
		$startLimit = $this->getPager()->getStartLimit()-1;
		$admins = Ccc::getModel('Admin');
		$query = "SELECT `adminId` ,`firstName`, `lastName`  FROM `Admin` order by `adminId` desc LIMIT {$startLimit} , {$this->getPager()->getPerPageCount()}";
		$admins =  $admins->fetchAll($query);
		if(!$admins)
		{
			$action = new Controller_Core_Action();
			$this->getPager()->setCurrent(($this->getPager()->getCurrent() == 1) ? 1 :$action->redirect(null,null,['p'=>$this->getPager()->getCurrent()-1]));
		}
		// print_r($admins);die()
		return $admins;
	}
}