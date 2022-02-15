<?php require_once('Model\Core\Adapter.php'); 
	Ccc::loadClass('Controller_Core_Front');
   date_default_timezone_set("Asia/Kolkata");
   $date = date('Y-m-d H:i:s');
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
	public $front = null;

	public function getFront()
	{
		if(!$this->front)
		{
			$front = new Controller_Core_Front();
			$this->setFront($front);
		}
		return $this->front;
	}
	public function setFront($front)
	{
		$this->front=$front;
		return $this;
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
	public static function init()
	{
		$this->init();
	}
}
$ccc = new Ccc();
$ccc->getFront()->init();
//Ccc::init();

?>