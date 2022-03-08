<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Price_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/price/grid.php');
	}

	public function getProducts()
	{
		return $this->getData();
	}

}