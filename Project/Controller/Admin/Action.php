<?php Ccc::loadClass('Controller_Core_Action') ?>

<?php

class Controller_Admin_Action extends Controller_Core_Action
{
	public function getMessage()
	{
		if(!$this->message)
		{
			$this->setMessage(Ccc::getModel('Admin_Message'));
		}
		return $this->message;
	}
}