<?php Ccc::getBlock('Core_Layout'); ?>
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

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if(!$this->layout){
			$this->setlayout(new Block_Core_layout);
		}
		return $this->layout;
	}

	public function renderLayout()
	{
		$this->getLayout()->toHtml();
	}
	
}
