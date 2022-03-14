<?php 
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Core_Response');

class Controller_Core_Front{
	protected $request = null;
	protected $response = null;

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
	
	public function setResponse($response)
	{
		$this->response = $response;
		return $response;
	}
	public function getResponse()
	{
		if(!$this->response)
		{
			$this->setResponse(new Model_Core_Response());
		}
		return $this->response;
	}
	public function init()
	{
		$actionName = $this->getRequest()->getActionName();
		$controllerName = $this->getRequest()->getControllerName();
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
