<?php 
class Model_Core_Request{
	public function isPost()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			return true;
		}
		return false;
	}

	public function getPost($key=null,$value=null)
	{
		if(!$this->isPost())
		{
			return null;
		}
		if(!$key)
		{
			return $_POST;
		}
		if(!array_key_exists($key, $_POST))
		{
			return $value;
		}
		return $_POST[$key];
	}

	public function getRequest($key=null,$value=null)
	{
		if(!$key)
		{
			return $_REQUEST;
		}
		if(!array_key_exists($key, $_REQUEST))
		{
			return $value;
		}
		return $_REQUEST[$key];
	}
	
	public function getActionName()
	{
		return $this->getRequest('a','error').'Action';
	}

	public function getControllerName()
	{
		return $this->getRequest('c','Customer');
	}

}

?>