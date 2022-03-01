<?php Ccc::loadClass('Controller_Core_Action');?>

<?php
class Controller_Config extends Controller_Core_Action
{
	
	public function gridAction()
	{	
		Ccc::getBlock('Config_Grid')->toHtml();
	}

	public function addAction()
	{
		$config = Ccc::getModel('Config');
		Ccc::getBlock('Config_Edit')->setData(['config'=>$config])->toHtml();
	}

	public function editAction()
	{
		try 
		{
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) 
      		{
      			throw new Exception("Invalid Id.", 1);
      		}
			$config = Ccc::getModel('Config')->load($id);
			if (!$config) 
      		{
      			throw new Exception("Unable to Load Config.", 1);
      		}
     		Ccc::getBlock('Config_Edit')->addData('config',$config)->toHtml();

		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));
			//echo $e->getMessage();
		}
		
	}
	
	public function saveAction()
	{
		try
		{

			$configRow = Ccc::getModel('Config');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);				
			}
			if (!$request->getPost('config')) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			

			$row = $request->getPost('config');
			print_r($row);
			if (array_key_exists('configId', $row))
			{
				if(!(int)$row['configId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$configRow->setData($row);
				$update = $configRow->save();
				if(!$update)
				{ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else
			{
				$configRow->setData($row);
				$configRow->createdAt = date('Y-m-d H:i:s');
				$insert = $configRow->save();
				if(!$insert)
				{	
					throw new Exception("System is unable to insert.", 1);
				}
			}
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));
		}
	}

	public function deleteAction()
	{
		try 
		{	

			$configRow = Ccc::getModel('Config');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$id=$request->getRequest('id');
			$configRow = $configRow->load($id);
			if(!$configRow)
			{

				throw new Exception("Record not found.", 1);
			}
			$delete = $configRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid',null,null,true));	
		}
	}
}