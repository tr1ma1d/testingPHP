<?php
    header('Content-Type: application/json');

    try{
        $dsn = 'pgsql:host=localhost dbname=auth port=5432';
        $db_username = 'postgres';
        $db_password = 'admin';

        $dbh = new PDO($dsn, $db_username, $db_password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $dbh->query('SELECT id, name, description FROM checkbox_info');
        $checkboxes = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $checkboxes]);




    }catch(Exception $e){
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $e->getMessage()]);
    }
?>