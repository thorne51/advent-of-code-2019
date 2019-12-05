<?php
$input = explode(',', file_get_contents('input.txt'));
define('OPCODE_EXIT', '99');
define('OPCODE_ADD', '1');
define('OPCODE_MULTIPLY', '2');

function runProgram($noun, $verb, $input) {

    $input[1] = $noun;
    $input[2] = $verb;

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

    return $input[0];
}

for ($verb = 0; $verb <= 99; $verb++) {
    for ($noun = 0; $noun <= 99; $noun++) {
        if (19690720 === runProgram($noun, $verb, $input)) {
            echo "100 * noun + verb: " . (100 * $noun + $verb) . PHP_EOL;
            exit;
        }
    }
}