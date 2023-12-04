<?php
$inputLines = file('../input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

function normalizeAndSplitNumbers(string $numbers): array
{
    return explode(' ', preg_replace('/\s+/', ' ', trim($numbers)));
}

$sum = 0;

foreach ($inputLines as $cardInput) {
    $matches = [];
    if (preg_match('/Card\s+\d+:\s(?<winning_numbers>[0-9\s]+)\s\|\s(?<elf_numbers>[0-9\s]+)/', $cardInput, $matches)) {
        $winningNumbers = normalizeAndSplitNumbers($matches['winning_numbers']);
        $elfNumbers = normalizeAndSplitNumbers($matches['elf_numbers']);

        $matchingNumber = array_intersect($winningNumbers, $elfNumbers);

        $sum += count($matchingNumber) > 0
            ? 2 ** (count($matchingNumber) - 1)
            : 0;
    }
}

echo $sum;