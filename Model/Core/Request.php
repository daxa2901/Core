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
		if(!$key)
		{
			if(!$value)
			{
				return $_POST;
			}
			return $value;
		}
		if(!array_key_exists($key, $_POST))
		{
			if(!$value)
			{
				return null;
			}
			return $value;
		}
		return $_POST[$key];
	}

	public function getRequest($key=null,$value=null)
	{
		if(!$key)
		{
			if(!$value)
			{
				return $_REQUEST;
			}
			return $value;
		}
		if(!array_key_exists($key, $_REQUEST))
		{
			if(!$value)
			{
				return null;
			}
			return $value;
		}
		return $_REQUEST[$key];
	}
	
	public function getActionName()
	{
		return (isset($_GET['a'])) ? $_GET['a'].'Action' : 'errorAction';
	}

	public function getControllerName()
	{
		return (isset($_GET['c'])) ? $_GET['c'] : 'Customer';
	}

}

?>