<?php
declare(strict_types=1);

$scores = [60, 75, 80, 90, 70, 85];

// Calculate stats
$avg = array_sum($scores) / count($scores);
$max = max($scores);
$min = min($scores);

// Filter scores greater than average
$topScores = [];
foreach ($scores as $score) {
    if ($score > $avg) {
        $topScores[] = $score;
    }
}

// Output
echo "Avg: " . round($avg, 1) . PHP_EOL;
echo "Max: " . $max . PHP_EOL;
echo "Min: " . $min . PHP_EOL;
echo "Top: ";
print_r($topScores);
