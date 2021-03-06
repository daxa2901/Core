<?php $adapter = Ccc::getModel('Core_Adapter'); ?>
<?php date_default_timezone_set("Asia/Kolkata"); ?>

<?php 

class Ccc
{
	public static $front = null;

	public static function register($key,$value)
	{
		$GLOBALS[$key] = $value;
	}

	public static function getRegistry($key)
	{
		if(array_key_exists($key,$GLOBALS))
		{
			return $GLOBALS[$key];
		}
		return null;
	}

	public static function unregister($key)
	{
		if(array_key_exists($key,$GLOBALS))
		{
			unset($GLOBALS[$key]);
		}
	}

	public function getConfig($key)
	{
		if(!$config = self::getRegistry('config'))
		{
			$config = self::loadFile('etc/config.php');
			self::register('config',$config);
		}
		if (array_key_exists($key,$config)) 
		{
			return $config[$key];
		}
		return null;
	}

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
		return require_once(self::getPath($path));
	}

	public static function loadClass($className)
	{
		$path = str_replace("_", "\\", $className).'.php';
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
	
	public function getPath($subPath = null)
	{
		$path = getcwd().DIRECTORY_SEPARATOR;
		if ($subPath) 
		{
			return $path.$subPath;
		}
		return $path;
	}
	public function getBaseUrl($subUrl = null)
	{
		$url = self::getConfig('baseUrl');
		if ($subUrl) 
		{
			return $url.$subUrl;
		}
		return $url;
	}

	public static function init()
	{
		self::getFront()->init();
	}
}
Ccc::init();

?>