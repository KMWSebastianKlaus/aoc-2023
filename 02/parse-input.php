<?php

function parseInput(string $fileName): array
{
    $inputLines = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $parsedInput = [];
    foreach ($inputLines as $gameInput) {
        $matches = [];
        if (preg_match('/Game\s(?<id>\d+):\s(?<subsets>.+)/', $gameInput, $matches)) {
            $parsedInput[(int)$matches['id']] = array_map(
                static fn(string $subset) => array_reduce(
                    explode(', ', $subset),
                    static function (array $current, string $cubeResult) {
                        $cubeResultArray = explode(' ', $cubeResult);
                        return [...$current, $cubeResultArray[1] => (int)$cubeResultArray[0]];
                    },
                    []
                ),
                explode('; ', $matches['subsets'])
            );
        }
    }

    return $parsedInput;
}