<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>

<?php 
class Block_Salseman_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('personal');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title'=>'Salseman Information',
			'block'=>'Salseman_Edit_Tabs_Personal',
			'url'=>$this->getUrl(null,'salseman',['tab'=>'personal'])
		],'personal');

		$this->addTab([
			'title'=>'Manage Customers',
			'block'=>'Salseman_Edit_Tabs_Customer',
			'url'=>$this->getUrl(null,null,['tab'=>'customer'])
		],'customer' );
		return $this;
	}

}