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
		$id = $this->id;
		$medias = Ccc::getModel('Category_Media');
		$query = "SELECT cm.*,c.`base`,c.`thumb`,c.`small` FROM `category_media` cm 
					JOIN `category` c 
						ON cm.`categoryId` = c.`categoryId`
				WHERE c.`categoryId` = {$id}";
		$medias = $medias->fetchAll($query);
		return $medias;
	}
}