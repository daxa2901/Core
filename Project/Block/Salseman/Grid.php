<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Salseman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salseman/grid.php');
	}

	public function getSalsemans()
	{
		$model = Ccc::getModel('Salseman');
		$query = "SELECT * FROM salseman";
		$salsemans = $model->fetchAll($query);
		return $salsemans;
		
	}
}