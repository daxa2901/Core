<?php 
Ccc::loadClass('Model_Core_Row');
class Model_Admin_Login extends Model_Core_Row
{

	public function __construct()
	{
		parent::__construct();
	}

	public function isLoggedIn()
	{
		$adminSession = Ccc::getModel('Admin_Session');
		if($adminSession->login)
		{
			return true;
		}
		return false;
	}

	public function login(array $data)
	{
		if($this->isLoggedIn())
		{
			return false;
		}
		Ccc::getModel('Admin_Session')->login = $data;
		return $this;
	}

	public function logout()
	{
		if($this->isLoggedIn())
		{
			unset(Ccc::getModel('Admin_Session')->login);
			return $this;
		}
		return false;
	}
}