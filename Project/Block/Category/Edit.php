<?php Ccc::loadClass('Block_Core_Edit'); ?>

<?php 
class Block_Category_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('view/category/edit.php');
	}

	// public function getCategory()
	// {
	// 	return $this->category;
	// }

	// public function getCategoryPathPair()
	// {
 //        $categoryPathPair = $this->getAdapter()->fetchPair('SELECT `categoryId`,`categoryPath` FROM `Category`');
	// 	return $categoryPathPair;
	// }

	// public function getCategoryToPath()
 //   {
	// 		return Ccc::getModel('Category')->getCategoryToPath();
	// }
}