<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Layout_Header extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/header.php');
	}
	// public function getMenu()
	// {
	// 	$this->addChild(Ccc::getBlock('Core_Layout_Header_Menu'));
	// 	$menus = $this->getChildren();
	// 	return $menus;
	// }
	
	// public function getMessages()
	// 	{
	// 		$this->addChild(Ccc::getBlock('Core_Layout_Header_Message'));
	// 		$messages = $this->getChildren();
	// 		return $messages;
	// 	}

}