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
		$query = "SELECT p.*,pm.media FROM Product p LEFT JOIN product_media pm ON p.productId = pm.productId";
		$products = $productRow-> fetchAll($query);
		return $products;
	}
}