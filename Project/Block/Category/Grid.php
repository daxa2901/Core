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
				c.*,cm.media 
			FROM Category c LEFT JOIN category_media cm ON c.categoryId = cm.categoryId order by c.categoryPath";
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