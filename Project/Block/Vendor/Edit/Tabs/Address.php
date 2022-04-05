<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Vendor_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit/tabs/address.php');
	}

	public function getVendor()
	{
		return Ccc::getRegistry('vendor');
	}
	
	public function getAddress()
	{
		$vendor =  Ccc::getRegistry('vendor');
		return $vendor->getAddress();
	}
}