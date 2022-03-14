<?php Ccc::loadClass('Controller_Admin_Action') ?>

<?php

class Controller_Admin_Login extends Controller_Admin_Action
{
	public function loginAction()
	{
		$this->setPageTitle('Admin Login');
		$content = $this->getLayout()->getContent();
		$adminLogin = Ccc::getBlock('Admin_Login_Grid');
		$content->addChild($adminLogin);
		$this->renderLayout();		
	}
	
	public function logoutAction()
	{
		try 
		{
			$this->setPageTitle('Admin Logout');
			$login = Ccc::getModel('Admin_Login')->logout();
			if($login)
			{
				$this->getMessage()->addMessage('You are logout successfully.');
			}
			$this->redirect('login');
			
		} catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('login');			
		}
				
	}
	
	public function loginPostAction()
	{
		try 
		{
			$this->setPageTitle('Admin LoginPost');
			$request = $this->getRequest();
			if(!$request->isPost() ||  !$request->getPost('login'))
			{
				throw new Exception("Invalid Request.", 1);				
			}
			$row = $request->getPost('login');
			$password = md5($row['password']);
			$query = "SELECT * FROM `admin` WHERE `password` = '{$password}' AND `email` = '{$row['email']}'";
			$admin = $this->getAdapter()->fetchRow($query);
			if (!$admin) 
			{
				throw new Exception("Invalid emailId or password.", 1);
			}
			$login = Ccc::getModel('Admin_Login')->login($admin);
			if($login)
			{
				$this->getMessage()->addMessage('You are logged in successfully.');
			}
			$this->redirect('grid','product');
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('login');
		}
		
	}
}