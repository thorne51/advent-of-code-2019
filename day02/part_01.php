<?php
$input = explode(',', file_get_contents('input.txt'));
//$input = explode(',', '1,1,1,4,99,5,6,0,99');
define('OPCODE_EXIT', '99');
define('OPCODE_ADD', '1');
define('OPCODE_MULTIPLY', '2');

$input[1] = 12;
$input[2] = 2;

$currentPosition = 0;
while(true) {
    $opcode = $input[$currentPosition];
    if ($opcode === OPCODE_EXIT) {
        break;
    }

    $input1Pos = $input[$currentPosition + 1];
    $input2Pos = $input[$currentPosition + 2];
    $outputPos = $input[$currentPosition + 3];

    switch ($opcode) {
        case OPCODE_ADD:
            $input[$outputPos] = $input[$input1Pos] + $input[$input2Pos];
            break;

        case OPCODE_MULTIPLY:
            $input[$outputPos] = $input[$input1Pos] * $input[$input2Pos];
            break;

        default:
            throw new InvalidArgumentException("Invalid opcode '" . $opcode . "'" . PHP_EOL);
    }

    $currentPosition += 4;
}

echo implode(',', $input) . PHP_EOL;