<?php Ccc::loadClass('Block_Core_Edit'); ?>

<?php 
class Block_Product_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('view/product/edit.php');
	}

	public function getProduct()
	{
		return $this->product;
	}

	public function getCategories()
	{
		$categoryTable = Ccc::getModel('Category');
		$query = "SELECT 
		 		*
			FROM `Category` WHERE `status` = 1";
		$category = $categoryTable->fetchAll($query);	
		return $category;
	}

	public function getCategoryToPath()
   {
		return Ccc::getModel('Category')->getCategoryToPath();
	}

	// public function getCategoryProductPair()
	// {
	// 	return $this->categoryProductPair;
					
	// }
}