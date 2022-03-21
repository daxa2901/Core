<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category_Product extends Model_Core_Row
{
	
	protected $category = null;
	protected $product = null;
	public function __construct()
	{
		$this->setResourceClassName('Category_Product_Resource');
		parent::__construct();
	}

	public function setProduct($products)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product');
		if (!$this->entityId) 
		{
			return $productModel;
		}	
		if ($this->product && !$reload) 
		{
			return $this->product;
		}
		$query = "SELECT * FROM {$productModel->getResource()->getTableName()} WHERE productId = {$this->productId}";
		$product = $productModel->fetchRow($query);
		if (!$product) 
		{
			return $productModel;
		}
		$this->setProduct($product);
		return $this->product;
	}

	public function setCategory($category)
	{
		$this->category = $category;
		return $this;
	}

	public function getCategory($reload = false)
	{
		$categoryModel = Ccc::getModel('Category');
		if (!$this->entityId) 
		{
			return $categoryModel;
		}	
		if ($this->category && !$reload) 
		{
			return $this->category;
		}
		$query = "SELECT * FROM {$categoryModel->getResource()->getTableName()} WHERE categoryId = {$this->categoryId}";
		$category = $categoryModel->fetchRow($query);
		if (!$category) 
		{
			return $categoryModel;
		}
		$this->setCategory($category);
		return $this->category;
	}
}