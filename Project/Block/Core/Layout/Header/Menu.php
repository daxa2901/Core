<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Layout_Header_Menu extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/menu.php');
	}

	public function getLogin()
	{
		return Ccc::getModel('Admin_Login')->isLoggedIn();
	}

}