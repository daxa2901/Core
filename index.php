<?php Ccc::loadClass('Model_Core_Adapter'); 
$adapter = new Model_Core_Adapter();
date_default_timezone_set("Asia/Kolkata");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./style.css">

</head>
<body>
	<div class='index'>
		<a href="index.php?c=category&a=grid"><button type="button" class="cancel">Category</button></a>
		<a href="index.php?c=product&a=grid"><button type="button" class="cancel">Product</button></a>
		<a href="index.php?c=customer&a=grid"><button type="button" class="cancel">Customer</button></a>
		<a href="index.php?c=admin&a=grid"><button type="button" class="cancel">Admin</button></a>
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