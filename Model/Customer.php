<?php 
Ccc::loadClass('Model_Core_Table');
class Model_Customer extends Model_Core_Table{
	public function __construct()
	{
		$this->setTableName('Customer')->setPrimaryKey('customerId');
	}
}
