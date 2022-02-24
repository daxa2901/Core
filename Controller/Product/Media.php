<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Product_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Product_Media_Grid')->toHtml();
	}
	
	public function saveAction()
	{
		$mediaRow = Ccc::getModel('Product_Media');
		$request = $this->getRequest();
		if(!$request->isPost())
		{
			throw new Exception("Invalid Request.", 1);				
		}
		if (!$request->getPost('media')) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
		$row = $request->getPost('media');
		echo "<pre>";
		print_r($row);
		print_r($this->getRequest()->getRequest());
		print_r(Ccc::getModel('Product_Media'));
		print_r($this);
		// Ccc::getBlock('Product_Media_Grid')->toHtml();
	}

}
