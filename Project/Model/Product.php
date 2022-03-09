<?php 
Ccc::loadClass('Model_Core_Row');
class Model_Product extends Model_Core_Row
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL,
		];

		if(!$key)
		{
			return $statuses;
		}

		if (array_key_exists($key,$statuses)) 
		{	
			return $statuses[$key];
		}
		return self::STATUS_DEFAULT;
	}

	public function saveCategories($categoryIds)
	{
		if(!$categoryIds)
		{
			$delete = $this->getResource()->getAdapter()->delete("DELETE FROM `category_product` WHERE `productId` = ({$this->productId})"); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete.", 1);							
			}
		}
		else
		{
			$query = "SELECT `entityId`,`categoryId` FROM `category_product` WHERE `productId` = {$this->productId}";
			 $categoryProductPair=$this->getResource()->getAdapter()->fetchPair($query);
			 if (!$categoryProductPair) {
			 	$categoryProductPair = [];
			 }

			foreach (array_diff($categoryIds, $categoryProductPair) as $key => $value) 
			{
				$categoryProductRow = Ccc::getModel('Category_Product');
				$categoryProductRow->productId = $this->productId;
				$categoryProductRow->categoryId = $value;
				$insert = $categoryProductRow->save();
			}

			$ids = implode(',',array_keys(array_diff($categoryProductPair, $categoryIds)));
			if($ids)
			{
				$query = "DELETE FROM `category_product` WHERE `entityId` IN ({$ids})";
				$delete = $this->getResource()->getAdapter()->delete($query);
				
			}
		}
	}
}

