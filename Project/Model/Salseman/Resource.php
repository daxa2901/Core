<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php

class Model_Salseman_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setPrimaryKey('salsemanId')->setTableName('salseman');
		parent::__construct();
	}
}