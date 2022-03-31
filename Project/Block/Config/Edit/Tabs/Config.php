<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Config_Edit_Tabs_Config extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/config/edit/tabs/config.php');
	}

	public function getConfig()
	{
		return Ccc::getRegistry('config');
	}
}