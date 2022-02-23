<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer_Address extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Customer_Address_Resource');
		parent::__construct();
	}
}