<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>

<?php 
class Block_Customer_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('personal');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title'=>'personal Information',
			'block'=>'Customer_Edit_Tabs_Personal',
			'url'=>$this->getUrl(null,null,['tab'=>'personal'])
		],'personal' );
		$this->addTab([
			'title'=>'Billing Address Information',
			'block'=>'Customer_Edit_Tabs_Billing',
			'url'=>$this->getUrl(null,null,['tab'=>'billing'])
		],'billing' );
		$this->addTab([
			'title'=>'Shipping Address Information',
			'block'=>'Customer_Edit_Tabs_Shipping',
			'url'=>$this->getUrl(null,null,['tab'=>'shipping'])
		],'shipping' );
		return $this;
	}

}