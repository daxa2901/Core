<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 
class Model_Vendor_Resource extends Model_Core_Row_Resource{
	public function __construct()
	{
		$this->setTableName('vendor')->setPrimaryKey('vendorId');
		parent::__construct();
	}
}
