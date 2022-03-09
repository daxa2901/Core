<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Config_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
	}

	public function getConfigs()
	{
		$configRow = Ccc::getModel('Config');
		$query = "SELECT * FROM `config`";
		return $configRow-> fetchAll($query);
	}
}