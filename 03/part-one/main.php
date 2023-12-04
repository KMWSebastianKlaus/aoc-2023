<?php
$inputLines = file('../input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

function mergeCheckLines(?string $prevLine, ?string $nextLine): string
{
    $lineLength = max(strlen($prevLine ?? ''), strlen($nextLine ?? ''));
    $resultLine = '';
    for ($charIndex = 0; $charIndex < $lineLength; ++$charIndex) {
        $prevChar = $prevLine[$charIndex] ?? '.';
        if (is_numeric($prevChar)) {
            $prevChar = '.';
        }

        $nextChar = $nextLine[$charIndex] ?? '.';
        if (is_numeric($nextChar)) {
            $nextChar = '.';
        }

        if ($prevChar !== '.' || $nextChar !== '.') {
            $resultLine .= '#';
            continue;
        }

        $resultLine .= '.';
    }

    return $resultLine;
}

$lineCount = count($inputLines);
$result = 0;
for ($index = 0; $index < $lineCount; ++$index) {
    $currentLine = $inputLines[$index];

    if (!preg_match('/\d+/', $currentLine)) {
        // ignore lines without numbers
        continue;
    }

    $prevLine = null;
    if ($index > 0) {
        $prevLine = $inputLines[$index - 1];
    }
    $nextLine = null;
    if ($index < $lineCount - 1) {
        $nextLine = $inputLines[$index + 1];
    }

    $checkLine = mergeCheckLines($prevLine, $nextLine);
    $checkLine = mergeCheckLines($checkLine, $currentLine);

    $charCount = strlen($currentLine);
    $currentNumber = '';
    $numberStartIndex = null;
    for ($charIndex = 0; $charIndex <= $charCount; ++$charIndex) {
        $currentChar = $currentLine[$charIndex] ?? '';
        if (is_numeric($currentChar)) {
            $currentNumber .= $currentLine[$charIndex];
        }

        if (null === $numberStartIndex && is_numeric($currentChar)) {
            $numberStartIndex = $charIndex;
        }

        if (null !== $numberStartIndex && !is_numeric($currentChar)) {
            $offset = max($numberStartIndex - 1, 0);

            $checkRange = substr(
                $checkLine,
                $offset,
                0 === $numberStartIndex
                    ? strlen($currentNumber) + 1
                    : strlen($currentNumber) + 2
            );

            if (str_contains($checkRange, '#')) {
                $result += (int)substr($currentLine, $numberStartIndex, $charIndex);
            }

            $currentNumber = '';
            $numberStartIndex = null;
            $numberEndIndex = null;
        }
    }
}

echo sprintf(
    "Result: %s",
    $result
);