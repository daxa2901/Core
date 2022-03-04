<?php 

class Model_Core_Session
{
	public function __construct()
	{
		$this->start();
	}

	public function start()
	{
		if(!$this->getId())
		{
			session_start();
		}
		return $this;
	}

	public function getId()
	{
		return session_id();
	}

	public function regenerateId()
	{
		if(!$this->getId())
		{
			$this->start();
		}
		
		return session_regenerate_id();
	}

	public function destroy()
	{
		if($this->getId())
		{
			session_destroy();
		}
		return $this;
	}

	public function __set($key,$value)
	{
		if (!$this->getId()) 
		{
			$this->start();
		}
		$_SESSION[$key] = $value;
		return $this;	
	}

	public function __get($key)
	{
		if (!$this->getId()) 
		{
			return null;
		}
		if(!array_key_exists($key,$_SESSION))
		{
			return null;
		}
		return $_SESSION[$key];
	}

	public function __unset($key)
	{
		if (!$this->getId()) 
		{
			$this->start();
		}
		if(array_key_exists($key,$_SESSION))
		{
			unset($_SESSION[$key]);
		}
		return $this;
	}
}