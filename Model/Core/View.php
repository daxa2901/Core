<?php
class Model_Core_View{

	public $temlate = null;
	public $data = null;

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
	public function setTemplate($temlate)
	{
		$this->temlate = $temlate;
		return $this;
	}

	public function getTemplate()
	{
		return $this->temlate;
	}

	public function toHtml()
	{
		require($this->getTemplate());
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData($key=null)
	{
		if(!$key)
		{
			return $this->data;
		}
		if(!array_key_exists($key, $this->data))
		{
			return false;
		}
		return $this->data[$key];
	}

	public function addData($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if(!array_key_exists($key, $this->data))
		{
			return false;
		}
		unset($this->data[$key]);
		return $this;
	}

	public function getUrl($action=null,$controller=null,$parameters=[],$reset=false)
	{
		$temp = [];
		$request = Ccc::getFront()->getRequest();
		
		if(!$action)
		{
			$temp['a'] = $request->getRequest('a');
		}
		else
		{
			$temp['a'] = $action;
		}
		
		if(!$controller)
		{
			$temp['c'] = $request->getRequest('c');
		}
		else
		{
			$temp['c'] = $controller;
		}

		if($reset)
		{
			if($parameters)
			{
				$temp = array_merge($temp,$parameters);
			}
		}
		else
		{
			$temp = array_merge($_GET,$temp);
			if($parameters)
			{
				$temp = array_merge($temp,$parameters);
			}
		}
		$url = 'index.php?'.http_build_query($temp);
		return $url;
	}
}