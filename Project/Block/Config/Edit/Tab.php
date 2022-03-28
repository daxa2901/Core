<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>

<?php 
class Block_Config_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('config');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title'=>'Config Information',
			'block'=>'Config_Edit_Tabs_Config',
			'url'=>$this->getUrl(null,null,['tab'=>'config'])
		],'config' );
		return $this;
	}

}