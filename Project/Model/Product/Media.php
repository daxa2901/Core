<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Product_Media extends Model_Core_Row
{
	protected $product = null;
	protected $path = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Product_Media_Resource');
		$this->setPath('media\product');
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
		$path =  Ccc::getPath($this->getPath()).DIRECTORY_SEPARATOR.$imagename;
		// echo $path; die();
		if(!move_uploaded_file($temp_name,$path))
		{
			throw new Exception("Unable to Upload image111.", 1);
		}
		
		return $imagename;
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}
	
	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product');
		if (!$this->mediaId) 
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

	public function getImageUrl()
	{
		return Ccc::getBaseUrl($this->getPath().'/'.$this->media);
	}
}