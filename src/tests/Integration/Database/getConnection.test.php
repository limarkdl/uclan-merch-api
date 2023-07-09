<?php
function testGetConnection() {
    $database = new Database();
    $conn = $database->getConnection();
    $passed = $conn !== null;
    $message = $passed ? 'Connection established successfully' : 'Failed to establish connection';
    return ['Database: Get Connection', $passed, $message];
}
