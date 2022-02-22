<?php
echo "<pre>";
echo " Function 1:array_change_key_case() will change the case of all key in array.<br>" ;
$input_array = ["naMe" => 'daxa', "agE" => 22];
print_r(array_change_key_case($input_array, CASE_UPPER));
print_r(array_change_key_case($input_array, CASE_LOWER));
echo "============================<br>";

echo " Function 2:array_chunk(array array, int length, bool preserve_keys = false): it will split an array into chunks <br>";
$input_array = ['a', 'b', 'c', 'd', 'e'];
print_r(array_chunk($input_array, 2));
print_r(array_chunk($input_array, 2, true));
echo "============================<br>";

echo " Function 3:array_comine() :Creates an array by using one array for keys and another for its values.<br>";
$a = array('name', 'age', 'mobile');
$b = array('daxa', 22, 957443434);
print_r(array_combine($a, $b));
echo "============================<br>";

echo " Function 4:array_count_values(array) : Counts all the values of an array.<br>";
$a = [1,1,3,4,5,6,7,5,2];
print_r(array_count_values($a));
echo "============================<br>";

echo " Function 5:array_diff_assoc() :Computes the difference of arrays with additional index check.<br>";
$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "green", "yellow", "red");
print_r(array_diff_assoc($array1, $array2));
echo "============================<br>";


echo " Function 6:array_diff — Computes the difference of arrays. <br>";
$array1 = array("a" => "green", "red", "blue", "red");
$array2 = array("b" => "green", "yellow", "red");
print_r(array_diff($array1, $array2));
echo "============================<br>";

echo " Function 7:array_fill_keys() :Fill an array with values, specifying keys. <br>";
$keys = array('foo', 5, 10, 'bar');
 print_r(array_fill_keys($keys, 'banana'));
echo "============================<br>";

echo "Function 8:array_fill() : Fill an array with values <br>";
$a = array_fill(5, 6, 'banana');
$b = array_fill(-2, 4, 'pear');
print_r($a);
echo "<br>";
print_r($b);
echo "============================<br>";

echo "Function 9:array_filter — Filters elements of an array using a callback function<br>";
function odd($var)
{
    // returns whether the input integer is odd
    return $var & 1;
}

function even($var)
{
    // returns whether the input integer is even
    return !($var & 1);
}

$array1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
$array2 = [6, 7, 8, 9, 10, 11, 12];

echo "Odd :\n";
print_r(array_filter($array1, "odd"));
echo "<br>";
echo "Even:\n";
print_r(array_filter($array2, "even"));
echo "============================<br>";

echo "Function 10: array_flip() : Exchanges all keys with their associated values in an array<br>";
$input = array("oranges", "apples", "pears");
echo "Before flip : ";
print_r($input);
echo "<br>";
print_r(array_flip($input));
echo "============================<br>";

echo "Function 11: array_intersect_assoc(): Computes the intersection of arrays with additional index check <br>";
$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "green", "b" => "yellow", "blue", "red");
print_r(array_intersect_assoc($array1, $array2));
echo "============================<br>";

echo "Function 12: array_intersect_key(): Computes the intersection of arrays using keys for comparison <br>";
$array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
$array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);
print_r(array_intersect_key($array1, $array2));
echo "============================<br>";

echo "Function 13: array_intersect() : Computes the intersection of arrays<br>";
$array1 = array("a" => "green", "red", "blue");
$array2 = array("b" => "green", "yellow", "red");
print_r(array_intersect($array1, $array2));
echo "============================<br>";

echo "Function 14: array_key_exists() : Checks if the given key or index exists in the array<br>";
$array = array('first' => 1, 'second' => 4);
if (array_key_exists('first', $array)) {
    echo "The 'first' element is in the array<br>";
}
echo "============================<br>";

echo "Function 15: array_key_first() : Gets the first key of an array<br>";
$a = ['name' => 'daxa', 'age' => 22];
print_r(array_key_first($a));
echo "<br>============================<br>";

echo 'Function 16: array_key_last() : Gets the last key of an array<br>';
$a = ['name' => 'daxa', 'age' => 22];
print_r(array_key_last($a));
echo "<br>============================<br>";

echo 'Function 17: array_keys() : Return all the keys or a subset of the keys of an array<br>';
$a = ['name' => 'daxa', 'age' => 22];
print_r(array_keys($a));
echo "<br>============================<br>";

echo 'Function 18: array_map() : Applies the callback to the elements of the given arrays<br>';

function cube($n)
{
    return ($n * $n * $n);
}

$a = [1, 2, 3, 4, 5];
$b = array_map('cube', $a);
print_r($b);
echo "<br>============================<br>";

echo "Function 19: array_pop() : Pop the element off the end of array<br>";
$a = [1, 2, 3, 4, 5];
print_r(array_pop($a));
echo "<br>============================<br>";

echo "Function 20: array_push() : Push one or more elements onto the end of array.<br>";
$a = [1, 2, 3, 4, 5];
print_r(array_push($a,6,7));
echo "<br>============================<br>";
?>