<?php Ccc::loadClass('Controller_Admin_Action');?>

<?php
class Controller_Admin extends Controller_Admin_Action
{
	
	public function indexAction()
	{
		$this->setPageTitle('Admin Page');
		$content = $this->getLayout()->getContent();
		$adminRow = Ccc::getBlock('Admin_Index');
		$content->addChild($adminRow);
		$this->renderLayout();
	}

	public function gridAction()
	{	
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$adminBlock = Ccc::getBlock('Admin_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $adminBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
	}
	
	public function addAction()
	{
		$this->setPageTitle('Admin Add');
		$admin = Ccc::getModel('Admin');
		Ccc::register('admin',$admin);
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$adminBlock = Ccc::getBlock('Admin_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $adminBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
	}

	public function editAction()
	{
		try{
			$this->setPageTitle('Admin Edit');
			$id=(int)$this->getRequest()->getRequest('id');
      		if (!$id) {
      			throw new Exception("Invalid Id.", 1);
      		}

			$admin = Ccc::getModel('Admin')->load($id);
      		if (!$admin){
      			throw new Exception("Unable to Load Admin.", 1);
      		}
      		Ccc::register('admin',$admin);
      		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$adminBlock = Ccc::getBlock('Admin_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'elements' =>[
					[
						'element' => '#indexContent',
						'content' => $adminBlock
					],

					[
						'element' => '#indexMessage',
						'content' => $messageBlock
					]

				]
			];
		$this->renderJson($response);
		
		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$this->gridAction();
		}
		
	}
	
	public function saveAction()
	{
		try
		{
			$this->setPageTitle('Admin Save');
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if(!$request->isPost() ||  !$request->getPost('admin'))
			{
				throw new Exception("Invalid Request.", 1);				
			}
			
			$row = $request->getPost('admin');
			if (array_key_exists('adminId', $row))
			{
				$admin = Ccc::getModel('Admin')->load($row['adminId']);
				$admin->updatedDate = date('Y-m-d H:i:s');
			}
			else
			{
				if($row['password'] !=$row['confirmPassword']) 
				{
					throw new Exception("password must be same.", 1);
				}

				unset($row['confirmPassword']);
				$admin = Ccc::getModel('Admin');
				$row['password'] = md5($row['password']);
				$admin->createdDate = date('Y-m-d H:i:s');
			}

			$admin->setData($row);
			$admin = $admin->save();
			if(!$admin)
			{	
				throw new Exception("System is unable to insert.", 1);
			}

			$messages->addMessage('Admin details saved Successfully.');
			$this->gridAction();
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$this->setPageTitle('Admin Delete');
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
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
			}

			$messages->addMessage('Admin detail deleted successfully.');
			$this->gridAction();
		} 
		catch (Exception $e) {
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
	public function multipleDeleteAction()
	{
		try 
		{
			$messages = $this->getMessage();
			$request = $this->getRequest();
			if(!$request->isPost('delete'))
			{
				throw new Exception("Invalid Request.", 1);				
			}
			
			$row = $request->getPost('delete');
			if (array_key_exists('all',$row)) 
			{
				$query = "DELETE FROM `admin`";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			else
			{
				$ids = implode(',',array_values($row['selected']));
				$query = "DELETE FROM `admin` WHERE `adminId` IN ({$ids})";
				$delete = $this->getAdapter()->delete($query);
				if (!$delete) 
				{
					throw new Exception("System is unable to delete.", 1);
				}
			}
			$messages->addMessage('Admin detail deleted successfully.');
			$this->gridAction();
			
		} 
		catch (Exception $e) 
		{
			$messages->addMessage($e->getMessage(),get_class($messages)::ERROR);
			$this->gridAction();
		}
	}
}