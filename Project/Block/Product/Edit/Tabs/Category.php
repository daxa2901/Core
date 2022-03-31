<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Product_Edit_Tabs_Category extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/category.php');
	}

	public function getProduct()
	{
		return Ccc::getRegistry('Product');
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

	public function getCategoryProductPair()
	{
		$product = Ccc::getRegistry('Product');
		$categoryProductPair = [];
		if ($product->productId) 
		{
			$query = "SELECT `entityId`,`categoryId` 
     						FROM `category_product` 
     				WHERE `productId` = {$product->productId}";
     		$categoryProductPair = $this->getAdapter()->fetchPair($query);
		}	
		return $categoryProductPair;
					
	}
}