<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Layout_Header extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/core/layout/header.php');
	}

	public function getMenus()
	{
		return $this->getBlock('Core_Layout_Header_Menu');
	}
	public function getMessages()
	{
		return $this->getBlock('Core_Layout_Header_Message');
	}
}