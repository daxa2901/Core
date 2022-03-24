<?php
class Model_Core_View{

	public $temlate = null;
	public $data = [];

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
		ob_start();
		require($this->getTemplate());
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function __set($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}
	public function getData()
	{
		return $this->data;
	}

	public function __get($key)
	{
		if(!array_key_exists($key, $this->data))
		{
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		if(array_key_exists($key, $this->data))
		{
			unset($this->data[$key]);
		}
		return $this;
	}

	public function getUrl($action=null,$controller=null,$parameters=[],$reset=false)
	{
		$temp = [];
		$request = Ccc::getFront()->getRequest();
		
		$temp['a'] = (!$action) ? $request->getRequest('a') : $action;
		$temp['c'] = (!$controller)? $request->getRequest('c') : $controller;

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
		if(($key =  array_search(null, $temp)))
		{
			unset($temp[$key]);
		}
		return 'index.php?'.http_build_query($temp);
	}

}