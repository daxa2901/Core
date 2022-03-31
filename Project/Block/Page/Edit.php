<?php Ccc::loadClass('Block_Core_Edit'); ?>

<?php 
class Block_Page_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
		//$this->setTemplate('view/page/edit.php');
	}

	// public function getPage()
	// {
	// 	return $this->page;
	// }
}