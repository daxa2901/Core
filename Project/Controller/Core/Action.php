<?php
class Controller_Core_Action
{
	protected $layout = null;
	protected $message = null;
	
	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	public function redirect($action=null,$controller=null,$parameters=[],$reset=false)
	{
		$url = $this->getLayout()->getUrl($action,$controller,$parameters,$reset);
		header('location:'.$url);	
		exit();			
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if(!$this->layout)
		{
			$this->setlayout(Ccc::getBlock('Core_Layout'));
		}
		return $this->layout;
	}

	public function renderLayout()
	{
		$this->getLayout()->toHtml();
	}

	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}
	
	public function getMessage()
	{
		if(!$this->message)
		{
			$this->setMessage(Ccc::getModel('Core_Message'));
		}
		return $this->message;
	}
	
}
