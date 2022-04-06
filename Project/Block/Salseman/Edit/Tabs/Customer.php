<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Salseman_Edit_Tabs_Customer extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/salseman/edit/tabs/customer.php');
	}

	public function getCustomers()
	{
		$salseman = Ccc::getRegistry('salseman');
		if ($salseman->salsemanId) 
		{
			$customers = Ccc::getModel('Customer');
			$query = "SELECT 
						* 
						FROM `customer` 
					WHERE `salsemanId` = {$salseman->salsemanId} OR `salsemanId` IS NULL AND `status` = 1";
			$customers =  $customers->fetchAll($query);
			return $customers;
		}
		return false;
	}

	public function getSalseman()
	{
		return Ccc::getRegistry('salseman');
	}


}