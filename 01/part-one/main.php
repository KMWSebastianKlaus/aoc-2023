<?php

function getSumOfFirstAndLastNumber(string $inputLine): int
{
    $numbersOnlyString = preg_replace('/\D+/', '', $inputLine);

    $firstNumber = $numbersOnlyString[0];

    return strlen($numbersOnlyString) === 1
        ? (int)sprintf('%s%s', $firstNumber, $firstNumber)
        : (int)sprintf('%s%s', $firstNumber, $numbersOnlyString[-1]);

}

$inputLines = file('../input.txt', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

$sum = array_reduce(
    $inputLines,
    static fn(int $currenSum, string $inputLine) => $currenSum + getSumOfFirstAndLastNumber($inputLine),
    0
);

echo sprintf('Sum: %s', $sum);