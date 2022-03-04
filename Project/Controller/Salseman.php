<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php 

class Controller_Salseman extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$salsemanRow = Ccc::getBlock('Salseman_Grid');
		$content->addChild($salsemanRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$salseman = Ccc::getModel('Salseman');
		$salsemanRow = Ccc::getBlock('Salseman_Edit')->setdata(['salseman'=>$salseman]);
		$content = $this->getLayout()->getContent();
		$content->addChild($salsemanRow);
		$this->renderLayout();
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

      		$salsemanRow = Ccc::getBlock('Salseman_Edit')->setdata(['salseman'=>$salseman]);
			$content = $this->getLayout()->getContent();
			$content->addChild($salsemanRow);
			$this->renderLayout();

		} 
		catch (Exception $e) 
		{
			$messages = $this->getMessage();
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}

	public function saveAction()
	{
		try 
		{
			$messages = $this->getMessage();
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
				$messages->addMessage('Salseman Details Updated Successfully.');

			}
			else
			{
				$salsemanRow->setData($row);
				$salsemanRow->createdAt = date('Y-m-d H:i:s');
				$insert = $salsemanRow->save();
				if (!$insert) {
					throw new Exception("System is unable to Insert.", 1);
				}
				$messages->addMessage('Salseman Details Inserted Successfully.');
			}

			$this->redirect('grid',null,null,true);
		} 	
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
			
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$messages = $this->getMessage();
			$salsemanRow = Ccc::getModel('Salseman');
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
			$messages->addMessage('Salseman Details Deleted Successfully.');
			$this->redirect('grid',null,null,true);	
				
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);	
		}
	}
}