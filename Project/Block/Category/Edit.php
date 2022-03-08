<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit.php');
	}

	public function getCategory()
	{
		return $this->getData('category');
	}

	public function getCategoryPathPair()
	{
        $categoryPathPair = $this->getAdapter()->fetchPair('SELECT categoryId,categoryPath FROM Category');
		return $categoryPathPair;
	}

	public function getCategoryToPath()
    {
       return $this->getData('categoryPath');
	}
}