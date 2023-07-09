<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container mx-auto my-10">
    <h1 class="text-4xl mb-6 text-center">Test Report</h1>
    <div id="tests" class="grid grid-cols-1 md:grid-cols-2 gap-4">

    </div>
</div>
<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/DatabaseConnection/DatabaseConnection.test.php';


$tests = [testGetConnection()];

foreach ($tests as $test) {
    $testName = $test[0];
    $passed = $test[1];
    $message = $test[2];
    $bgColor = $passed ? 'bg-green-500' : 'bg-red-500';
    $icon = $passed ? '✓' : '✖';

    echo <<<HTML
    <div class="p-6 rounded shadow-md $bgColor text-white">
        <h2 class="text-2xl mb-2">$testName</h2>
        <p>$message</p>
        <p>$icon</p>
    </div>
HTML;
}
?>
</body>
</html>
