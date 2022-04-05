<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Category_Edit_Tabs_Media extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/media.php');
	}

	public function getMedias()
	{	
		$category = Ccc::getRegistry('category');
		if ($category->categoryId) 
		{
			$medias = Ccc::getModel('Category_Media');
			$query = "SELECT cm.*,c.`base`,c.`thumb`,c.`small` FROM `category_media` cm 
						JOIN `category` c 
							ON cm.`categoryId` = c.`categoryId`
					WHERE c.`categoryId` = {$category->categoryId}";
			return $medias->fetchAll($query);
		}
		return $medias;
	}

	public function getCategory()
	{
		return Ccc::getRegistry('category');
	}
}