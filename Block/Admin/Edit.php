<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Admin_Edit extends Block_Core_Template
{
		public function __construct()
		{
			$this->setTemplate('view/admin/edit.php');
		}

		public function getAdmin()
		{
			return $this->getData('admin');
		}
}