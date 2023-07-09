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
    <br />
        <p class="text-center"><?php
            date_default_timezone_set('Asia/Nicosia');
            echo date("Y-m-d H:i:s") . " Cyprus, Nicosia"
            ?></p>
    </div>
</div>
<?php

require_once __DIR__ . '/../../config/Database.php';

require_once __DIR__ . '/Database/getConnection.test.php';
require_once __DIR__ . '/controllers/UserController.test.php';

$tests = [testGetConnection(), testCreateUser(), testLoginUser(), testGetAllUsers(), testDeleteUser()];

foreach ($tests as $test) {
    $testName = $test[0];
    $passed = $test[1];
    $message = $test[2];
    $output = isset($test[3]) ? $test[3] : "No output for test";
    $bgColor = $passed ? 'bg-green-500' : 'bg-red-500';
    $icon = $passed ? '✓' : '✖';
    echo <<<HTML
    <div class="p-6 w-5/6 rounded mb-4 shadow-md ml-auto mr-auto $bgColor text-white">
        <h2 class="text-2xl mb-2">$testName</h2>
        <p>$message</p>
        <p>$icon</p>
         <code class="json">$output</code>
    </div>
HTML;
}
?>
</body>
</html>
