<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

if ($_SERVER["CONTENT_TYPE"] !== 'application/json') {
    http_response_code(400);
    echo json_encode(['error' => 'Bad request, JSON expected']);
    exit();
}

$data = json_decode(file_get_contents("php://input"));

if (json_last_error() !== JSON_ERROR_NONE || empty($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit();
}

if (!isset($data->id) || !is_numeric($data->id)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid or missing user id']);
    exit();
}

$userController = new UserController();

try {
    $userController->deleteUser(strip_tags($data->id));
    http_response_code(200);
    echo json_encode(['message' => 'User Deleted Successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}