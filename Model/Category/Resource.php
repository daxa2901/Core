<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 
class Model_Category_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('Category')->setPrimaryKey('categoryId');
		parent::__construct();
	}

}
