<?php

const DIGITS = [
    'one' => '1',
    'two' => '2',
    'three' => '3',
    'four' => '4',
    'five' => '5',
    'six' => '6',
    'seven' => '7',
    'eight' => '8',
    'nine' => '9',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
    '6' => '6',
    '7' => '7',
    '8' => '8',
    '9' => '9',
];

function getSumOfFirstAndLastNumber(string $inputLine): int
{
    $positions = [];
    foreach (DIGITS as $digit => $value) {
        $offset = 0;
        $currentPos = strpos($inputLine, $digit, $offset);
        while (false !== $currentPos) {
            $positions[$currentPos] = $value;
            $offset = $currentPos + 1;
            $currentPos = strpos($inputLine, $digit, $offset);
        }
    }

    ksort($positions);

    $normalizedString = implode('', $positions);

    $numbersOnlyString = preg_replace('/\D+/', '', $normalizedString);

    $firstNumber = $numbersOnlyString[0];

    return strlen($numbersOnlyString) === 1
        ? (int)sprintf('%s%s', $firstNumber, $firstNumber)
        : (int)sprintf('%s%s', $firstNumber, $numbersOnlyString[-1]);
}

$inputLines = file('../input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$sum = array_reduce(
    $inputLines,
    static fn(int $currenSum, string $inputLine) => $currenSum + getSumOfFirstAndLastNumber($inputLine),
    0
);

echo sprintf('Sum: %s', $sum);