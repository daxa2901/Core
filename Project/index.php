<?php $adapter = Ccc::getModel('Core_Adapter'); ?>
<?php date_default_timezone_set("Asia/Kolkata"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./style.css">

</head>
<body>

	<div class='index'>
		<a href="<?php echo Ccc::getBlock('Category_Grid')->getUrl('grid','category',null,true);?>"><button type="button" class="cancel">Category</button></a>
		<a href="<?php echo Ccc::getBlock('Product_Grid')->getUrl('grid','product',null,true);?>"><button type="button" class="cancel">Product</button></a>
		<a href="<?php echo Ccc::getBlock('Customer_Grid')->getUrl('grid','customer',null,true);?>"><button type="button" class="cancel">Customer</button></a>
		<a href="<?php echo Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',null,true);?>"><button type="button" class="cancel">Admin</button></a>
		<a href="<?php echo Ccc::getBlock('Config_Grid')->getUrl('grid','config',null,true);?>"><button type="button" class="cancel">Config</button></a>
		<a href="<?php echo Ccc::getBlock('Salseman_Grid')->getUrl('grid','salseman',null,true);?>"><button type="button" class="cancel">Salseman</button></a>
		<a href="<?php echo Ccc::getBlock('Vendor_Grid')->getUrl('grid','vendor',null,true);?>"><button type="button" class="cancel">Vendor</button></a>
		<a href="<?php echo Ccc::getBlock('Page_Grid')->getUrl('grid','page',null,true);?>"><button type="button" class="cancel">Page</button></a>
	</div>
</body>
</html>

<?php 

class Ccc
{
	public static $front = null;

	public static function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}

	public static function setFront($front)
	{
		self::$front=$front;
	}

	public static function loadFile($path)
	{
		require_once(getcwd().'/'.$path);
	}

	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}

	public function getModel($className)
	{
		$className = 'Model_'.$className;
		self::loadClass($className);
		return new $className;
	}
	
	public function getBlock($className)
	{
		$className = 'Block_'.$className;
		self::loadClass($className);
		return new $className;
	}
	
	public static function init()
	{
		self::getFront()->init();
	}
}
Ccc::init();

?>