<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Layout_Header extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/header.php');
	}

	public function getMenus()
	{
		$this->addChild(Ccc::getBlock('Core_Layout_Header_Menu'),'menus');
		return $this->getChild('menus');
	}
	public function getMessages()
	{
		$this->addChild(Ccc::getBlock('Core_Layout_Header_Message'),'message');
		return $this->getChild('message');
	}
}