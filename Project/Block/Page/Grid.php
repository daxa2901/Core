<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Page_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
	}

	public function getPages()
	{
		$pageRow = Ccc::getModel('Page');
		$query = "SELECT * FROM Page";
		return $pageRow-> fetchAll($query);
	}
}