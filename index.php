
<?php require_once('Model\Core\Adapter.php');  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		.cancel{
			background-color: green;
		}
		.container{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class='container'>
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
	public static function loadFile($path)
	{
		require_once($path);
	}
	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}
	public static function init()
	{
		$actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'errorAction';
		$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer';
		//$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerClassName = 'Controller_'.$controllerName;
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}
}

Ccc::init();

?>