<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Page_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/page/edit.php');
	}

	public function getPage()
	{
		return $this->page;
	}
}