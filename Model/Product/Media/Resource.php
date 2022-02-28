
<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 
class Model_Product_Media_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('product_media')->setPrimaryKey('mediaId')->setMediaPath('media/product');
		parent::__construct();
	}

}
