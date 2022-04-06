<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Salseman_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/salseman/edit/tabs/personal.php');
	}

	public function getSalseman()
	{
		return Ccc::getRegistry('salseman');
	}

	

}