<?php

include '../parse-input.php';

$games = parseInput('../input.txt');

const CUBE_COUNT = [
    'red'   => 12,
    'green' => 13,
    'blue'  => 14,
];

$sum = 0;
foreach ($games as $id => $subsets) {
    foreach ($subsets as $subset) {
        foreach ($subset as $cubeColor => $cubeCount) {
            if ($cubeCount > CUBE_COUNT[$cubeColor]) {
                continue 3;
            }
        }
    }

    $sum += $id;
}

echo sprintf('Sum: %s', $sum);