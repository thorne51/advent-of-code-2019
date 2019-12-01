<?php
$input = file_get_contents('input.txt');
$module_masses = array_filter(array_map('intval', explode(PHP_EOL, $input)), function($e) { return $e > 0; });
$array_map = [];
foreach ($module_masses as $key => $mass) {
    $module_fuel = 0;
    $fuel = 0;
    do {
        $module_fuel += $fuel;
        $fuel = floor($mass / 3) - 2;
        $mass = $fuel;
    } while ($fuel > 0);
    $array_map[$key] = $module_fuel;
}
$total = array_sum($array_map);
echo "Total fuel requirements: " . $total . PHP_EOL;