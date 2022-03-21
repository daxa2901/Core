<?php 
Ccc::loadClass('Model_Core_Row');
class Model_Product extends Model_Core_Row
{
	protected $media = null;
	protected $gallery = null;
	protected $categories = null;
	protected $cartItems = null;
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
		if(!$this->productId) {
			throw new Exception("Product is not loaded.", 1);
		}
		
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

	public function setMedia($media)
	{
		$this->media = $media;
		return $this;
	}
	
	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media');
		if (!$this->productId) 
		{
			return $mediaModel;
		}	
		if ($this->media && !$reload) 
		{
			return $this->media;
		}
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE productId = {$this->productId}";
		$media = $mediaModel->fetchAll($query);
		if (!$media) 
		{
			return $mediaModel;
		}
		$this->setMedia($media);
		return $this->media;
	}

	public function setGallery($gallery)
	{
		$this->gallery = $gallery;
		return $this;
	}
	
	public function getGallery($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media');
		if (!$this->productId) 
		{
			return $mediaModel;
		}	
		if ($this->gallery && !$reload) 
		{
			return $this->gallery;
		}
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE productId = {$this->productId} AND gallery = 1";
		$gallery = $mediaModel->fetchAll($query);
		if (!$gallery) 
		{
			return $mediaModel;
		}
		$this->setMedia($gallery);
		return $this->gallery;
	}

	public function getBase()
	{
		$mediaModel = Ccc::getModel('Product_Media');
		if (!$this->productId) 
		{
			return $mediaModel;
		}	
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE mediaId = {$this->base}";
		$base = $mediaModel->fetchRow($query);
		if (!$base) 
		{
			return $mediaModel;
		}
		return $base;
	}

	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Product_Media');
		if (!$this->productId) 
		{
			return $mediaModel;
		}	
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE mediaId = {$this->thumb}";
		$thumb = $mediaModel->fetchRow($query);
		if (!$thumb) 
		{
			return $mediaModel;
		}
		return $thumb;
	}

	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Product_Media');
		if (!$this->productId) 
		{
			return $mediaModel;
		}	
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE mediaId = {$this->small}";
		$small = $mediaModel->fetchRow($query);
		if (!$small) 
		{
			return $mediaModel;
		}
		return $small;
	}

	public function setCategories($categories)
	{
		$this->categories = $categories;
		return $this;
	}
	
	public function getCategories($reload = false)
	{
		$categoryProductModel = Ccc::getModel('Category_Product');
		if (!$this->productId) 
		{
			return $categoryProductModel;
		}	
		if ($this->categories && !$reload) 
		{
			return $this->categories;
		}
		$query = "SELECT * FROM {$categoryProductModel->getResource()->getTableName()} WHERE productId = {$this->productId}";
		$categories = $categoryProductModel->fetchAll($query);
		if (!$categories) 
		{
			return $categoryProductModel;
		}
		$this->setCategories($categories);
		return $this->categories;
	}

	public function setCartItems($categories)
	{
		$this->cartItems = $cartItems;
		return $this;
	}
	
	public function getcartItems($reload = false)
	{
		$cartItemModel = Ccc::getModel('Cart_Item');
		if (!$this->productId) 
		{
			return $cartItemModel;
		}	
		if ($this->cartItems && !$reload) 
		{
			return $this->cartItems;
		}
		$query = "SELECT * FROM {$cartItemModel->getResource()->getTableName()} WHERE productId = {$this->productId}";
		$cartItems = $cartItemModel->fetchAll($query);
		if (!$cartItems) 
		{
			return $cartItemModel;
		}
		$this->setCartItems($cartItems);
		return $this->cartItems;
	}
}

