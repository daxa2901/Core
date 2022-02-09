<?php
echo '<pre>';
/*
$data = [

	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

];

$final = [];
foreach ($data as $row) {
		if(!array_key_exists('category',$final)){
			$final['category']=[];		
		}

		if(!array_key_exists($row['category'],$final['category'])){
			$final['category'][$row['category']]=[];		
		}
		if(!array_key_exists('categoryName',$final['category'][$row['category']])){
			$final['category'][$row['category']]['categoryName']=$row['categoryname'];		
		}
		if(!array_key_exists('attribute',$final['category'][$row['category']])){
			$final['category'][$row['category']]['attribute']=[];		
		}
		if(!array_key_exists($row['attribute'],$final['category'][$row['category']]['attribute'])){
			$final['category'][$row['category']]['attribute'][$row['attribute']]=[];		
		}
		if(!array_key_exists('attributeName',$final['category'][$row['category']]['attribute'][$row['attribute']])){
			$final['category'][$row['category']]['attribute'][$row['attribute']]['attributeName']=$row['attributename'];
		}
		if(!array_key_exists('option',$final['category'][$row['category']]['attribute'][$row['attribute']])){
				$final['category'][$row['category']]['attribute'][$row['attribute']]['option']=[];
		}
		if(!array_key_exists($row['option'],$final['category'][$row['category']]['attribute'][$row['attribute']]['option'])){
				$final['category'][$row['category']]['attribute'][$row['attribute']]['option'][$row['option']]=[];
		}
		if(!array_key_exists('optionName',$final['category'][$row['category']]['attribute'][$row['attribute']]['option'])){
				$final['category'][$row['category']]['attribute'][$row['attribute']]['option'][$row['option']]['optionName']=$row['optionname'];
		}
		
}
print_r($final);*/

$data = [
	'category'=> [
		'1'=>[
			'name' => 'c1',
			'attribute'=>[
				'1' => [
					'name'=>'a1',
					'option' => [
						'1'=>[
							'name' => 'o1'
						],
						'2'=>[
							'name' => 'o2'
						]
					]
				],
				'2' => [
					'name'=>'a2',
					'option' => [
						'3'=>[
							'name' => 'o3'
						],
						'4'=>[
							'name' => 'o4'
						]
					]
				]
			]
		],
		'2'=>[
			'name' => 'c2',
			'attribute'=>[
				'3' => [
					'name'=>'a3',
					'option' => [
						'5'=>[
							'name' => 'o5'
						],
						'6'=>[
							'name' => 'o6'
						]
					]
				],
				'4' => [
					'name'=>'a4',
					'option' => [
						'7'=>[
							'name' => 'o7'
						],
						'8'=>[
							'name' => 'o8'
						]
					]
				]
			]
		]
	]
];

$result=[];

foreach ($data as $category=>$level1) {

	foreach ($level1 as $categoryId=>$level2) {
		$row['categoryId'] = $categoryId;
		foreach ($level2 as $categoryName => $level3) {
				if($categoryName != 'attribute'){
				$row['categoryName'] = $level3;
			}
		
			foreach ($level3 as $attribute => $level4) {
					$row['attribute'] = $attribute;
			
				foreach ($level4 as $attributeName => $level5) {
					if($attributeName != 'option'){
						$row['attributeName'] = $level5;
					}

					foreach ($level5 as $option => $level6) {
							$row['option'] = $option;
										
						foreach ($level6 as $optionName => $level7) {
							$row['optionName'] = $level7;
							array_push($result,$row);	
						}
											
					}
				}
			}
		}
	}
}
print_r($result);