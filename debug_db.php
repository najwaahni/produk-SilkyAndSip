<?php

$dbPath = __DIR__ . '/database/database.sqlite';
$db = new PDO('sqlite:' . $dbPath);

$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;")->fetchAll(PDO::FETCH_COLUMN);
$users = $db->query("SELECT id, name, email, is_admin FROM users ORDER BY id;")->fetchAll(PDO::FETCH_ASSOC);

$payload = [
    'database' => $dbPath,
    'tables' => $tables,
    'users' => $users,
];

file_put_contents(__DIR__ . '/debug_db.json', json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
