<?php 
Ccc::loadClass('Model_Core_Request');
class Controller_Core_Front{
	protected $request = null;

	public function setRequest($request)
	{
		$this->request = $request;
		return $request;
	}
	public function getRequest()
	{
		if(!$this->request)
		{
			$this->setRequest(new Model_Core_Request());
		}
		return $this->request;
	}
	public function init()
	{
		$actionName = $this->getRequest()->getActionName();
		$controllerName = $this->getRequest()->getControllerName();
		//$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerName = 'Controller_'.$controllerName;
		$controllerClassName =$this->parepareClassName($controllerName);
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();

	}
	public function parepareClassName($name)
	{
		$name = ucwords($name,'_');
		return $name;
	}
}
