<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>

<?php 
class Block_PaymentMethod_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('method');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title'=>'Method Information',
			'block'=>'PaymentMethod_Edit_Tabs_Method',
			'url'=>$this->getUrl(null,null,['tab'=>'method'])
		],'method' );
		return $this;
	}

}