<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Layout_Header_Message extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/message.php');
	}

	public function getMessages()
	{
		$messagesModel = Ccc::getModel('Core_Message');
		$messages=$messagesModel->getMessages();
		$messagesModel->unsetMessages();
		return $messages;
	}
}