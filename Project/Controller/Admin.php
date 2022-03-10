<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Admin extends Controller_Admin_Action
{
	
	public function gridAction()
	{	
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminRow);
		$this->renderLayout();
	}
	
	public function addAction()
	{
		$admin = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function editAction()
	{
		try{
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) {
      			throw new Exception("Invalid Id.", 1);
      		}

			$admin = Ccc::getModel('Admin')->load($id);
      		if (!$admin){
      			throw new Exception("Unable to Load Admin.", 1);
      		}

      		$content = $this->getLayout()->getContent();
			$adminRow = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
			$content->addChild($adminRow);
			$this->renderLayout();
		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
		}
		
	}
	
	public function saveAction()
	{
		try{
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if(!$request->isPost() ||  !$request->getPost('admin')){
				throw new Exception("Invalid Request.", 1);				
			}
			
			$row = $request->getPost('admin');
			if (array_key_exists('adminId', $row)){
				$admin = Ccc::getModel('Admin')->load($row['adminId']);
				$admin->updatedDate = date('Y-m-d H:i:s');
			}
			else{
				if($row['password'] !=$row['confirmPassword']) {
					throw new Exception("password must be same.", 1);
				}

				unset($row['confirmPassword']);
				$admin = Ccc::getModel('Admin');
				$admin->createdDate = date('Y-m-d H:i:s');
			}

			$admin->setData($row);
			$admin = $admin->save();
			if(!$admin){	
				throw new Exception("System is unable to insert.", 1);
			}

			$messages->addMessage('Admin details saved Successfully.');
			$this->redirect('grid',null,null,true);
		} 
		catch (Exception $e) {
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if (!$request->getRequest('id')) {
				throw new Exception("Invalid Request.", 1);
			}
			
			$id=$request->getRequest('id');
			$admin = Ccc::getModel('Admin')->load($id);
			if(!$admin){
				throw new Exception("Record not found.", 1);
			}

			$delete = $admin->delete(); 
			if(!$delete){
				throw new Exception("System is unable to delete record.", 1);
			}

			$messages->addMessage('Admin detail deleted successfully.');
			$this->redirect('grid',null,null,true);	
		} 
		catch (Exception $e) {
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->redirect('grid',null,null,true);	
		}
	}
}