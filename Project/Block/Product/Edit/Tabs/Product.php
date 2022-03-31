<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Product_Edit_Tabs_Product extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/product.php');
	}

	public function getProduct()
	{
		return Ccc::getRegistry('Product');
	}
}