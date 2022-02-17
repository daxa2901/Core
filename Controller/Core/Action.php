<?php Ccc::loadClass('Model_Core_View'); ?>

<?php
class Controller_Core_Action
{
	
	public $view = null;
	
	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	public function getUrl($action=	null,$controller=null,$parameters=[],$reset=false)
	{
		$temp = [];
		if(!$controller)
		{
			$temp['c'] = $this->getRequest()->getRequest('c');
		}
		else
		{
			$temp['c'] = $controller;
		}

		if(!$action)
		{
			$temp['a'] = $this->getRequest()->getRequest('a');
		}
		else
		{
			$temp['a'] = $action;
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
	
	public function redirect($url)
	{
		header('location:'.$url);	
		exit();			
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if(!$this->view){
			$this->setView(new Model_Core_View);
		}
		return $this->view;
	}
}
