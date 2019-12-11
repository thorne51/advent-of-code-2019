<?php
$input = explode('-', '254032-789860');
$numbers = range($input[0], $input[1]);
//$numbers = [111111, 223450, 123789, 222222, 247474];
//$numbers = [
//    300000,
//    310000,
//    311000,
//    311100,
//];

$passwords = [];
foreach ($numbers as $number) {
    $number = (string)$number;

    if (preg_match('/(.)\1{2}/', $number) === false) {
        continue;
    }

    $nrs = array_map('intval', str_split($number));
    if (
        $nrs[0] > $nrs[1]
        || $nrs[1] > $nrs[2]
        || $nrs[2] > $nrs[3]
        || $nrs[3] > $nrs[4]
        || $nrs[4] > $nrs[5]
    ) {
        continue;
    }

    $passwords[] = $number;
}

file_put_contents('output.csv', implode(PHP_EOL, $passwords));

echo count($passwords) . ' possible numbers' . PHP_EOL;
