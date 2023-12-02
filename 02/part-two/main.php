<?php


include '../parse-input.php';

$games = parseInput('../input.txt');

const CUBE_TEMPLATE_COUNT = [
    'red'   => -INF,
    'green' => -INF,
    'blue'  => -INF,
];

$sum = 0;
foreach ($games as $id => $subsets) {
    $minCubeCounts = CUBE_TEMPLATE_COUNT;
    foreach ($subsets as $subset) {
        foreach ($subset as $cubeColor => $cubeCount) {
            $minCubeCounts[$cubeColor] = max($minCubeCounts[$cubeColor], $cubeCount);
        }
    }

    $sum += array_reduce(
        $minCubeCounts,
        static fn (int $current, int $minCubeCount) => $current * $minCubeCount,
        1
    );
}

echo sprintf('Sum: %s', $sum);