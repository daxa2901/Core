<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 
class Model_Customer_Resource extends Model_Core_Row_Resource{
	public function __construct()
	{
		$this->setTableName('Customer')->setPrimaryKey('customerId');
		parent::__construct();
	}
}
