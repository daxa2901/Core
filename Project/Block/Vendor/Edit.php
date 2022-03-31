<?php Ccc::loadClass('Block_Core_Edit'); ?>

<?php 
class Block_Vendor_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('view/vendor/edit.php');
	}

	// public function getVendor()
	// {
	// 	return $this->vendor;
	// }

	// public function getAddress()
	// {
	// 	return $this->vendor->getAddress();
	// }
}