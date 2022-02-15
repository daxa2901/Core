<?php
Ccc::loadClass('Model_Core_View');

class Controller_Core_Action{
	
	public $view = null;
	
	public function getRequest()
	{
		global $ccc;
		return $ccc->getFront()->getRequest();
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
?>