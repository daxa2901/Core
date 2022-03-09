<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendors()
	{
		$vendorRow = Ccc::getModel('Vendor');
		$query = "SELECT v.*, a.`address` 
		FROM `Vendor` v JOIN `vendor_address` a ON v.`vendorId` = a.`vendorId`";
		$vendors = $vendorRow->fetchAll($query);
		return $vendors;
	}

}