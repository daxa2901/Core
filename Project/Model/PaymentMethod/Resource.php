<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 
class Model_PaymentMethod_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('paymentMethod')->setPrimaryKey('methodId');
		parent::__construct();
	}
}
