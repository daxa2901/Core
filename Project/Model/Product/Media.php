<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Product_Media extends Model_Core_Row
{
	protected $product = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Product_Media_Resource');
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

	public function uploadImage($file)
	{
		$file_name = pathinfo($file['name']['fileName'],PATHINFO_FILENAME);
		$temp_name=$file["tmp_name"]['fileName'];
		$ext = strtolower(pathinfo($file['name']['fileName'],PATHINFO_EXTENSION));
		if(!in_array($ext, ['png','jpg','jpeg']))
		{
			throw new Exception("Image must of type JPG, JPEG or  PNG", 1);
		}
		
		$imagename=$file_name.'_'.date("dmYhms").'.'.$ext;
		$path =  Ccc::getBlock('Product_Media_Grid')->baseUrl($this->getResource()->getMediaPath()).'\\'.$imagename;
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
		$product = $productModel->fetchAll($query);
		if (!$product) 
		{
			return $productModel;
		}
		$this->setProduct($product);
		return $this->product;
	}


}