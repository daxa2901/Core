<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category_Media extends Model_Core_Row
{
	protected $category = null;
	protected $path = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
		$this->setPath('media\category');
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

	public function getPath()
	{
		return $this->path;
	}

	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

	public function uploadImage($file)
	{
		$file_name = pathinfo($file['name'],PATHINFO_FILENAME);
		$temp_name=$file["tmp_name"];
		$ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
		if(!in_array($ext, ['png','jpg','jpeg']))
		{
			throw new Exception("Image must of type JPG, JPEG or  PNG", 1);
		}
		
		$imagename=$file_name.'_'.date("dmYhms").'.'.$ext;
		$path = Ccc::getPath($this->getPath()).DIRECTORY_SEPARATOR.$imagename;
		if(!move_uploaded_file($temp_name, $path))
		{
			throw new Exception("Unable to Upload image.", 1);
		}
		return $imagename;
	}

	public function setCategory($category)
	{
		$this->category = $category;
		return $this;
	}
	
	public function getCategory($reload = false)
	{
		$categoryModel = Ccc::getModel('category');
		if (!$this->mediaId) 
		{
			return $categoryModel;
		}	
		if ($this->category && !$reload) 
		{
			return $this->category;
		}
		$query = "SELECT * FROM {$categoryModel->getResource()->getTableName()} WHERE categoryId = {$this->categoryId}";
		$category = $categoryModel->fetchAll($query);
		if (!$category) 
		{
			return $categoryModel;
		}
		$this->setCategory($category);
		return $this->category;
	}

	public function getImageUrl()
	{
		return Ccc::getBaseUrl($this->getPath().'\\'.$this->media);
	}

}