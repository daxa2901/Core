<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Vendor_Address extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Vendor_Address_Resource');
		parent::__construct();
	}
}