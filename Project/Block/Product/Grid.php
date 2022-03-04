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
		$query = "SELECT 
		 		c.*,b.media as baseImage, t.media as thumbImage,s.media as smallImage
			FROM product c 
			LEFT JOIN product_media b 
				ON c.productId = b.productId AND (c.base = b.mediaId)
			LEFT JOIN product_media t 
				ON c.productId = t.productId AND (c.thumb = t.mediaId)
			LEFT JOIN product_media s 
				ON c.productId = s.productId AND (c.small = s.mediaId)";

		$products = $productRow-> fetchAll($query);
		return $products;
	}
}