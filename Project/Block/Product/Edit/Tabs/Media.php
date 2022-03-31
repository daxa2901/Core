<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Product_Edit_Tabs_Media extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/media.php');
	}

	public function getMedias()
	{
		$product = Ccc::getRegistry('Product');
		if ($product->productId) 
		{
			$medias = Ccc::getModel('Product_Media');
			$query = "SELECT pm.*,p.`base`,p.`thumb`,p.`small` 
					FROM `product_media` pm JOIN `product` p 
						ON pm.`productId` = p.`productId` 
					WHERE p.`productId` = {$product->productId}";
			return $medias->fetchAll($query);
		}
		return false;
	}

	public function getProduct()
	{
		return Ccc::getRegistry('Product');
	}
	
}