<?php $adapter = Ccc::getModel('Core_Adapter'); ?>
<?php date_default_timezone_set("Asia/Kolkata"); ?>

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