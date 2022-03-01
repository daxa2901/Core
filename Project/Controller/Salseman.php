<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php 

class Controller_Salseman extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Salseman_Grid')->toHtml();
	}

	public function addAction()
	{
		$salseman = Ccc::getModel('Salseman');
		Ccc::getBlock('Salseman_Edit')->setdata(['salseman'=>$salseman])->toHtml();
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
			$salseman = Ccc::getModel('salseman')->load($id);
      		if (!$salseman) 
      		{
      			throw new Exception("Unable to Load salseman.", 1);
      		}
     		Ccc::getBlock('Salseman_Edit')->setData(['salseman'=>$salseman])->toHtml();

		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Salseman_Grid')->getUrl('grid',null,null,true));
		}
	}

	public function saveAction()
	{
		try 
		{
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid Request.", 1);
			}

			if(!$request->getPost('salseman'))
			{
				throw new Exception("Invalid Request", 1);
			}
			$row = $request->getPost('salseman');
			$salsemanRow = Ccc::getModel('Salseman');
			if(array_key_exists('salsemanId',$row))
			{
				if(!(int)$row['salsemanId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$salsemanRow->setData($row);
				$salsemanRow->updatedAt = date('Y-m-d H:i:s');
				$update = $salsemanRow->save();
				if (!$update) {
					throw new Exception("System is unable to update.", 1);
				}

			}
			else
			{
				$salsemanRow->setData($row);
				$salsemanRow->createdAt = date('Y-m-d H:i:s');
				$insert = $salsemanRow->save();
				if (!$insert) {
					throw new Exception("System is unable to Insert.", 1);
				}
			}

			$this->redirect(Ccc::getBlock('Salseman_Grid')->getUrl('grid',null,null,true));
		} 	
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Salseman_Grid')->getUrl('grid',null,null,true));
			
		}
	}

	public function deleteAction()
	{
		try 
		{	$salsemanRow = Ccc::getModel('Salseman');
			$request = $this->getRequest();
			if (!$request->getRequest('id')) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$id=$request->getRequest('id');
			$salsemanRow = $salsemanRow->load($id);
			if(!$salsemanRow)
			{
				throw new Exception("Record not found.", 1);
			}
			$delete = $salsemanRow->delete(); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect(Ccc::getBlock('Salseman_Grid')->getUrl('grid',null,null,true));	
				
		} 
		catch (Exception $e) 
		{
			$this->redirect(Ccc::getBlock('Salseman_Grid')->getUrl('grid',null,null,true));	
		}
	}
}