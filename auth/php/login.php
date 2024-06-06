<?php
header('Content-Type: application/json');

try {
    // Подключение к базе данных
    $dsn = 'pgsql:host=localhost dbname=auth port=5432';
    $db_username = 'postgres';
    $db_password = 'admin';
    $dbh = new PDO($dsn, $db_username, $db_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получение данных из POST-запроса
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['username']) || !isset($data['password'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    $username = trim($data['username']);
    $password = trim($data['password']);

    // Запрос к базе данных
    $stmt = $dbh->prepare('SELECT password FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // Проверка пароля
    if ($user && ($password === $user['password'])) { //($user && password_verify($password, $user['password']))
        echo json_encode(['success' => true]);
    } else {
        echo $user['password'];
        //echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()]);
}


