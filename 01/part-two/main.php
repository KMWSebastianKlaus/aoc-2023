<?php

const SPELLED_DIGITS = ['one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9'];
const DIGITS = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

function getSumOfFirstAndLastNumber(string $inputLine): int
{
    // TODO find combined
    $combinedSpelledDigits = findCombinedSpelledDigits();

    $normalizedString = str_replace(
        array_keys($combinedSpelledDigits),
        $combinedSpelledDigits,
        $inputLine,
    );

    $normalizedString = str_replace(
        array_keys(SPELLED_DIGITS),
        SPELLED_DIGITS,
        $normalizedString,
    );

    echo sprintf('%s -> %s', $inputLine, $normalizedString);

    $numbersOnlyString = preg_replace('/\D+/', '', $normalizedString);

    echo sprintf(" -> %s\n", $numbersOnlyString);

    $firstNumber = $numbersOnlyString[0];

    $result = strlen($numbersOnlyString) === 1
        ? (int)sprintf('%s%s', $firstNumber, $firstNumber)
        : (int)sprintf('%s%s', $firstNumber, $numbersOnlyString[-1]);

    echo sprintf(" -> %s\n\n", $result);

    return $result;
}

$inputLines = file('example.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$sum = array_reduce(
    $inputLines,
    static fn(int $currenSum, string $inputLine) => $currenSum + getSumOfFirstAndLastNumber($inputLine),
    0
);

echo sprintf('Sum: %s', $sum);