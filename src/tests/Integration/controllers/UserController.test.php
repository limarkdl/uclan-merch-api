<?php

require_once __DIR__ . '/../../../controllers/UserController.php';

function testGetAllUsers() {
    $controller = new UserController();
    ob_start();
    $controller->getAllUsers();
    $output = ob_get_contents();
    ob_end_clean();
    $decoded = json_decode($output, true);
    $passed = is_array($decoded);
    $message = $passed ? 'All users retrieved successfully' : 'Failed to retrieve all users';
    return ['User Controller: Get All Users', $passed, $message];
}

function testCreateUser() {
    $controller = new UserController();
    $testData = [
        'username' => 'testUser',
        'password' => 'testPassword',
        'email' => 'testemail@test.com',
    ];

    ob_start();
    try {
        $controller->createUser($testData);
    } catch (Exception $e) {
    }
    $output = ob_get_contents();
    ob_end_clean();

    $decoded = json_decode($output, true);
    $passed = isset($decoded['message']) && $decoded['message'] == 'User Created';
    $message = $passed ? 'User created successfully' : 'Failed to create user';
    return ['User Controller: Create User', $passed, $message, $output];
}

function testLoginUser() {

    $controller = new UserController();
    $testData = [
        'username' => 'testUser',
        'password' => 'testPassword',
    ];

    // Start output buffering
    ob_start();

    $controller->loginUser($testData);
    // Get the contents from the buffer
    $output = ob_get_contents();

    // End and clean the buffer
    ob_end_clean();

    // Decode the output to an associative array
    $outputArray = json_decode($output, true);

    // Check if the user is logged in based on the output message
    $passed = isset($outputArray['message']) && $outputArray['message'] == 'Successfully';

    $message = $passed ? 'User login successful' : 'Failed to login user';

    return ['User Controller: Login User', $passed, $message, $output];
}


function testDeleteUser() {
    $userController = new UserController();
    $user = new User();
    $testUser = $user->getUserByUsername('testUser');
    ob_start();
    try {
        $userController->deleteUser($testUser['id']);
        $passed = true;
        $message = 'User deleted successfully';
    } catch (Exception $e) {
        $passed = false;
        $message = $e->getMessage();
    }
    $output = ob_get_contents();
    ob_end_clean();

    return ['User Controller: Delete User', $passed, $message, $output];
}