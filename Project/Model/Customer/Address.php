<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer_Address extends Model_Core_Row
{
	const BILLING = 1;
	const BILLING_DEFAULT = 2;
	const SHIPPING_DEFAULT = 2;
	const SHIPPING = 2;

	public function __construct()
	{
		$this->setResourceClassName('Customer_Address_Resource');
		parent::__construct();
	}
}