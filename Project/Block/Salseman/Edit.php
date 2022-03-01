<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Salseman_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salseman/edit.php');
	}

	public function getSalseman()
	{
		return $this->getData('salseman');
	}
}