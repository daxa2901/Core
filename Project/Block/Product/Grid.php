<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Product_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function getProducts()
	{
		$productRow = Ccc::getModel('Product');
		$query = "SELECT * FROM Product";
		$products = $productRow-> fetchAll($query);
		return $products;
	}
}