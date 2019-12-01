<?php
$input = file_get_contents('input.txt');
$module_masses = array_map('intval', explode(PHP_EOL, $input));
$array_map = [];
foreach ($module_masses as $key => $e) {
    if ($e > 0) {
        $array_map[$key] = floor($e / 3) - 2;
    }
}
$total = array_sum($array_map);
echo "Total fuel requirements: " . $total . PHP_EOL;