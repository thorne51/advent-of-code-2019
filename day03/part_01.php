<?php
$input = file_get_contents('input.txt');
$input = file_get_contents('example01.txt');
//$input = file_get_contents('example02.txt');
//$input = file_get_contents('example03.txt');

function manhattan_distance($vector1, $vector2)
{
    $n = count($vector1);
    $sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $sum += abs($vector1[$i] - $vector2[$i]);
    }
    return $sum;
}

$wires = array_filter(explode(PHP_EOL, $input));
$grid = [['o']];
$crosses = [];

foreach ($wires as $wireNr => $wire) {
    $paths = explode(',', $wire);
    $currentPos = ['x' => 0, 'y' => 0];
    echo "Wire #" . $wireNr . ": " . $wire . PHP_EOL;

    foreach ($paths as $path) {
        $direction = substr($path, 0, 1);
        $distance = intval(substr($path, 1));
        echo "Going from {$currentPos['x']},{$currentPos['y']} {$path}" . PHP_EOL;

        switch ($direction) {
            case 'U':
                foreach (range(1, $distance) as $y) {
                    if (isset($grid[$currentPos['x']][$currentPos['y'] + $y]) && $grid[$currentPos['x']][$currentPos['y'] + $y] !== $wireNr) {
                        $crosses[] = [$currentPos['x'], $currentPos['y'] + $y];
                        echo "- Intersection at " . $currentPos['x'] . "," . ($currentPos['y'] + $y) . " which is " . manhattan_distance([0,0], [$currentPos['x'], $currentPos['y'] + $y]) . " far." . PHP_EOL;
                    } else {
                        $grid[$currentPos['x']][$currentPos['y'] + $y] = $wireNr;
                    }
                }
                $currentPos['y'] += $distance;
                break;

            case 'D':
                for ($y = 1; $y <= $distance; $y++) {
                    if (isset($grid[$currentPos['x']][$currentPos['y'] - $y]) && $grid[$currentPos['x']][$currentPos['y'] - $y] !== $wireNr) {
                        $crosses[] = [$currentPos['x'], $currentPos['y'] - $y];
                        echo "- Intersection at " . $currentPos['x'] . "," . ($currentPos['y'] - $y) . " which is " . manhattan_distance([0,0], [$currentPos['x'], $currentPos['y'] - $y]) . " far." . PHP_EOL;
                    } else {
                        $grid[$currentPos['x']][$currentPos['y'] - $y] = $wireNr;
                    }
                }
                $currentPos['y'] -= $distance;
                break;

            case 'R':
                for ($x = 1; $x <= $distance; $x++) {
                    if (isset($grid[$currentPos['x'] + $x][$currentPos['y']]) && $grid[$currentPos['x'] + $x][$currentPos['y']] !== $wireNr) {
                        $crosses[] = [$currentPos['x'] + $x, $currentPos['y']];
                        echo "- Intersection at " . ($currentPos['x'] + $x) . "," . $currentPos['y'] . " which is " . manhattan_distance([0,0], [$currentPos['x'] + $x, $currentPos['y']]) . " far." . PHP_EOL;
                    } else {
                        $grid[$currentPos['x'] + $x][$currentPos['y']] = $wireNr;
                    }
                }
                $currentPos['x'] += $distance;
                break;

            case 'L':
                for ($x = 1; $x <= $distance; $x++) {
                    if (isset($grid[$currentPos['x'] - $x][$currentPos['y']]) && $grid[$currentPos['x'] - $x][$currentPos['y']] !== $wireNr) {
                        $crosses[] = [$currentPos['x'] - $x, $currentPos['y']];
                        echo "- Intersection at " . ($currentPos['x'] - $x) . "," . $currentPos['y'] . " which is " . manhattan_distance([0,0], [$currentPos['x'] - $x, $currentPos['y']]) . " far." . PHP_EOL;
                    } else {
                        $grid[$currentPos['x'] - $x][$currentPos['y']] = $wireNr;
                    }
                }
                $currentPos['x'] -= $distance;
                break;
        }

        echo "Now at {$currentPos['x']},{$currentPos['y']}" . PHP_EOL . PHP_EOL;
    }
}

$manhattanDistances = [];
foreach ($crosses as $i => $cross) {
    $manhattanDistances[] = manhattan_distance([0, 0], $cross);
}
echo min($manhattanDistances) . PHP_EOL;