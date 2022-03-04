<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategory()
	{
		$categoryTable = Ccc::getModel('Category');
		$query = "SELECT 
		 		c.*,b.media as baseImage, t.media as thumbImage,s.media as smallImage
			FROM Category c 
			LEFT JOIN category_media b 
				ON c.categoryId = b.categoryId AND (c.base = b.mediaId)
			LEFT JOIN category_media t 
				ON c.categoryId = t.categoryId AND (c.thumb = t.mediaId)
			LEFT JOIN category_media s 
				ON c.categoryId = s.categoryId AND (c.small = s.mediaId)
		order by c.categoryPath";

		$category = $categoryTable->fetchAll($query);	
		return $category;
	}
	public function getCategoryToPath()
    {
        $categoryName=$this->getAdapter()->fetchPair('SELECT categoryId,name FROM Category');
        $categoryPath=$this->getAdapter()->fetchPair('SELECT categoryId,categoryPath FROM Category');
        $categories=[];
        foreach ($categoryPath as $key => $value) 
        {
                $explodeArray=explode('/', $value);
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) 
                {
                    if(array_key_exists($value,$categoryName))
                    {
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        }
        return $categories;
	}
}