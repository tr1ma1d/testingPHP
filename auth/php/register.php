<?php
header('Content-Type: application/json');

try {
    $dsn = 'pgsql:host=localhost;dbname=auth;port=5432';
    $db_username = 'postgres';
    $db_password = 'admin';

    $dbh = new PDO($dsn, $db_username, $db_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['username']) || !isset($data['password']) || !isset($data['email'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    $username = $data['username'];
    $password = $data['password'];
    $email = $data['email'];

    $query = $dbh->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $query->bindParam(':username', $username);
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
    } else {

        $query = $dbh->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->execute();
        echo json_encode(['success' => true]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $e->getMessage()]);
}catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()]);
}
