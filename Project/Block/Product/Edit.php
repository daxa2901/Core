<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Product_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit.php');
	}

	public function getProduct()
	{
		return $this->getData('product');
	}

	public function getCategories()
	{
		$categoryTable = Ccc::getModel('Category');
		$query = "SELECT 
		 		*
			FROM Category WHERE status = 1";
		$category = $categoryTable->fetchAll($query);	
		return $category;
	}

	public function getCategoryToPath()
    {
       return $this->getData('categoryPath');
	}

	public function getCategoryProductPair()
	{
		return $this->getData('categoryProductPair');
					
	}
}