<?php 

class Model_Core_Session
{
	protected $namespace = null;
	
	public function __construct()
	{
		$this->setNamespace('core');
		$this->start();
	}

	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
	}
	
	public function getNamespace()
	{
		return $this->namespace;
	}
	
	public function start()
	{
		if(!$this->isStarted())
		{
			session_start();
		}
		return $this;
	}

	public function isStarted()
	{
		if(!$this->getId())
		{
			return false;
		}
		return true;
	}

	public function getId($id = null)
	{
		if($id)
		{
			return session_id($id);
		}
		return session_id();
	}

	public function regenerateId()
	{
		if(!$this->isStarted())
		{
			$this->start();
		}
		return session_regenerate_id();
	}

	public function destroy()
	{
		if($this->isStarted())
		{
			session_destroy();
		}
		return $this;
	}

	public function __set($key,$value)
	{
		if (!$this->isStarted()) 
		{
			$this->start();
		}
		$_SESSION[$this->getNamespace()][$key] = $value;
		return $this;	
	}

	public function __get($key)
	{
		if (!$this->isStarted()) 
		{
			return null;
		}
		if (!array_key_exists($this->getNamespace(),$_SESSION)) 
		{
			$_SESSION[$this->getNamespace()] = [];
		}
		if(!array_key_exists($key,$_SESSION[$this->getNamespace()]))
		{
			return null;
		}
		return $_SESSION[$this->getNamespace()][$key];
	}

	public function __unset($key)
	{
		if (!$this->isStarted()) 
		{
			$this->start();
		}
		if (array_key_exists($this->getNamespace(),$_SESSION)) 
		{
			if(array_key_exists($key,$_SESSION[$this->getNamespace()]))
			{
				unset($_SESSION[$this->getNamespace()][$key]);
			}
		}
		return $this;
	}
}