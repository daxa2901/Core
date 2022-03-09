<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category_Media extends Model_Core_Row
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
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
		$temp_name=$file["tmp_name"];
		$ext = strtolower(pathinfo($file['name']['fileName'],PATHINFO_EXTENSION));
		if(!in_array($ext, ['png','jpg','jpeg']))
		{
			throw new Exception("Image must of type JPG, JPEG or  PNG", 1);
		}
		
		$imagename=$file_name.'_'.date("dmYhms").'.'.$ext;
		$path =  Ccc::getBlock('Category_Media_Grid')->baseUrl($this->getResource()->getMediaPath()).'\\'.$imagename;
		if(!move_uploaded_file($temp_name['fileName'], $path))
		{
			throw new Exception("Unable to Upload image.", 1);
		}
		return $imagename;
	}

}