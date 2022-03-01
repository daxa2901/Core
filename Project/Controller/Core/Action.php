<?php
class Controller_Core_Action
{
	protected $layout = null;
	
	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	public function redirect($url)
	{
		header('location:'.$url);	
		exit();			
	}
	
}
