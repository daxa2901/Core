<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Vendor_Address extends Model_Core_Row
{
	protected $vendor = null;
	public function __construct()
	{
		$this->setResourceClassName('Vendor_Address_Resource');
		parent::__construct();
	}

	public function setVendor($vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}

	public function getVendor($reload = false)
	{
		$vendorModel = Ccc::getModel('Vendor');
		if (!$this->addressId) 
		{
			return $vendorModel;
		}	
		if ($this->vendor && !$reload) 
		{
			return  $this->vendor;
		}
		$query = "SELECT * FROM {$vendorModel->getResource()->getTableName()} WHERE vendorId = {$this->vendorId}";
		$vendor = $vendorModel->fetchRow($query);
		if (!$vendor) 
		{
			return $vendorModel;
		}
		$this->setVendor($vendor);
		return $this->vendor;
	}
}