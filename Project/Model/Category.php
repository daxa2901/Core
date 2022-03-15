<?php 
Ccc::loadClass('Model_Core_Row');
class Model_Category extends Model_Core_Row
{
	protected $media = null;
	protected $gallery = null;
	protected $products = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Category_Resource');
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

	public function getCategoryToPath()
    {
        $categoryName=$this->getResource()->getAdapter()->fetchPair('SELECT categoryId,name FROM Category');
        $categoryPath=$this->getResource()->getAdapter()->fetchPair('SELECT categoryId,categoryPath FROM Category');
        $categories=[];
        foreach ($categoryPath as $key => $value) 
        {
                $explodeArray=explode('/', $value);
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) 
                {
                    if(array_key_exists($value,$categoryName))
                    {
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        }
        return $categories;
	}

	public function setMedia($media)
	{
		$this->media = $media;
		return $this;
	}
	
	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media');
		if (!$this->categoryId) 
		{
			return $mediaModel;
		}	
		if ($this->media && !$reload) 
		{
			return $this->media;
		}
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE categoryId = {$this->categoryId}";
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
		$mediaModel = Ccc::getModel('Category_Media');
		if (!$this->categoryId) 
		{
			return $mediaModel;
		}	
		if ($this->gallery && !$reload) 
		{
			return $this->gallery;
		}
		$query = "SELECT * FROM {$mediaModel->getResource()->getTableName()} WHERE categoryId = {$this->categoryId} AND gallery = 1";
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
		$mediaModel = Ccc::getModel('Category_Media');
		if (!$this->categoryId) 
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
		$mediaModel = Ccc::getModel('Category_Media');
		if (!$this->categoryId) 
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
		$mediaModel = Ccc::getModel('Category_Media');
		if (!$this->categoryId) 
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

	public function setProducts($products)
	{
		$this->products = $products;
		return $this;
	}
	
	public function getProducts($reload = false)
	{
		$categoryProductModel = Ccc::getModel('Category_Product');
		if (!$this->categoryId) 
		{
			return $categoryProductModel;
		}	
		if ($this->products && !$reload) 
		{
			return $this->products;
		}
		$query = "SELECT * FROM {$categoryProductModel->getResource()->getTableName()} WHERE categoryId = {$this->categoryId}";
		$products = $categoryProductModel->fetchRow($query);
		if (!$products) 
		{
			return $categoryProductModel;
		}
		$this->setProducts($products);
		return $this->products;
	}

	

}
