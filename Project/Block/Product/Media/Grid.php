<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Product_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/media/grid.php');
	}

	public function getMedias()
	{
		$id = $this->getData('id');
		$medias = Ccc::getModel('Product_Media');
		$query = "SELECT pm.*,p.`base`,p.`thumb`,p.`small` 
				FROM `product_media` pm JOIN `product` p 
					ON pm.`productId` = p.`productId` 
				WHERE p.`productId` = {$id}";
		return $medias->fetchAll($query);
	}
}