<?php
class Controller_Core_Action
{
	protected $layout = null;
	protected $message = null;
	
	public function __construct()
	{
		$this->authenticate();
	}

	public function setPageTitle($title)
	{
		$this->getLayout()->getHead()->setTitle($title);
		return $this;
	}
	private function authenticate()
	{
		$action = $this->getRequest()->getRequest('a');
		$controller = ucwords($this->getRequest()->getRequest('c'),'_');
		if($controller == 'Admin_Login' && ($action == 'login' || $action == 'loginPost'))
		{
			$login = Ccc::getModel('Admin_Login')->isLoggedIn();
			if ($login) 
			{
				$this->getMessage()->addMessage('You are already logged in.',get_class($this->getMessage())::ERROR);
				$this->redirect('grid','product');
			}
		}
		else
		{
			$login = Ccc::getModel('Admin_Login')->isLoggedIn();
			if (!$login) 
			{
				$this->getMessage()->addMessage('You have to  login first.',get_class($this->getMessage())::ERROR);
				$this->redirect('login','Admin_Login');
			}
		}
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getResponse()
	{
		return Ccc::getFront()->getResponse();
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
		$this->getResponse()
		->setHeader('content-type','text/html')
		->render($this->getLayout()->toHtml());
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
