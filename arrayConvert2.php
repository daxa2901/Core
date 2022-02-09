<?php
echo '<pre>';
/*
$data = [

	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];


$final = [];
foreach ($data as $row) {
	if (!array_key_exists($row['category'], $final)) {
			$final[$row['category']] = [];
	}
	if (!array_key_exists($row['attribute'],$final[$row['category']])) {
		$final[$row['category']][$row['attribute']] = [];
		// code...
	}
	$final[$row['category']][$row['attribute']][$row['option']] = $row['option'];
	
}
#print_r($final);

*/
$data = [
	'1'=>[
		'1' => [
			'1' => 1,
			'2' => 2		
		],
		'2' => [
			'3' => 3,
			'4' => 4		
		]
	],
	'2'=>[
		'3' => [
			'5' => 5,
			'6' => 6		
		],
		'4' => [
			'7' => 7,
			'8' => 8		
		]
	],
];


$final = [];
	foreach ($data as $categoryId=>$level1) {
			$row['categoryId'] = $categoryId;

		foreach ($level1 as $attribute=>$level2) {
				$row['attribute'] = $attribute;
				foreach ($level2 as $option => $vlevel3) {
					$row['option'] = $option;
				array_push($final, $row);

				}
		}
	}
print_r($final);


?>