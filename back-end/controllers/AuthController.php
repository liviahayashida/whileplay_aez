<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../config/database.php';

$userModel = new User($pdo);
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && $_GET['action'] === 'register') {
    $data = json_decode(file_get_contents('php://input'), true);
    $ok = $userModel->create($data['name'], $data['email'], $data['password']);
    echo json_encode(['success' => $ok]);
}

if ($method === 'POST' && $_GET['action'] === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user = $userModel->findByEmail($data['email']);

    if ($user && password_verify($data['password'], $user['password'])) {
        session_start();
        $_SESSION['user'] = $user['id'];
        echo json_encode(['success' => true, 'user' => $user['name']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
    }
}
