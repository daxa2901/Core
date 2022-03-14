<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php 

class Controller_Salseman extends Controller_Admin_Action
{
	public function gridAction()
	{
		$this->setPageTitle('Salseman Grid');
		$content = $this->getLayout()->getContent();
		$salsemanRow = Ccc::getBlock('Salseman_Grid');
		$content->addChild($salsemanRow);
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setPageTitle('Salseman Add');
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
			$this->setPageTitle('Salseman Edit');
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
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
		}
	}

	public function saveAction()
	{
		try 
		{
			$this->setPageTitle('Salseman Save');
			$request = $this->getRequest();
			if(!$request->isPost() || !$request->getPost('salseman'))
			{
				throw new Exception("Invalid Request", 1);
			}
			$row = $request->getPost('salseman');
			if(array_key_exists('salsemanId',$row))
			{
				if(!(int)$row['salsemanId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$salseman = Ccc::getModel('Salseman')->load($row['salsemanId']);
				$salseman->updatedAt = date('Y-m-d H:i:s');
			}
			else
			{
				$salseman = Ccc::getModel('Salseman');
				$salseman->createdAt = date('Y-m-d H:i:s');
				
			}
			$salseman->setData($row);
			$salseman = $salseman->save();
			if (!$salseman) 
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			$this->getMessage()->addMessage('Salseman saved successfully.');
			$this->redirect('grid',null,['id'=>null]);
		} 	
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);
			
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$this->setPageTitle('Salseman Delete');
			$id=$this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Id.", 1);
			}
			
			$salseman = Ccc::getModel('Salseman')->load($id);
			if(!$salseman)
			{
				throw new Exception("Record not found.", 1);
			}

			$salseman = $salseman->delete(); 
			if(!$salseman)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->getMessage()->addMessage('Salseman deleted successfully.');
			$this->redirect('grid',null,['id'=>null]);	
				
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),get_class($this->getMessage())::ERROR);
			$this->redirect('grid',null,['id'=>null]);	
		}
	}
}