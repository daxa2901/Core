<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Category_Edit_Tabs_Category extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/category.php');
	}

	public function getCategory()
	{
		return Ccc::getRegistry('category');
	}

	public function getCategoryPathPair()
	{
        $categoryPathPair = $this->getAdapter()->fetchPair('SELECT `categoryId`,`categoryPath` FROM `Category`');
		return $categoryPathPair;
	}

	public function getCategoryToPath()
   {
		return Ccc::getModel('Category')->getCategoryToPath();
	}	
}