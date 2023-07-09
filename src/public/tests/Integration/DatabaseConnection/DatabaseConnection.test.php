<?php

require_once __DIR__ . '/../../../config/Database.php';

function testGetConnection() {
    $database = new Database();
    $conn = $database->getConnection();
    $passed = $conn !== null;
    $message = $passed ? 'Connection established successfully' : 'Failed to establish connection';
    return ['Test Get Connection', $passed, $message];
}
// Run the test
testGetConnection();