<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/media/grid.php');
	}

	public function getMedias()
	{
		return $this->getData('media');

	}
}