<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Product_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit.php');
	}

	public function getProducts()
	{
		return $this->getData('product');
	}
}