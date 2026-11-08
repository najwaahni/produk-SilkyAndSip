<?php

$dbPath = __DIR__ . '/database/database.sqlite';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$columns = $db->query("PRAGMA table_info(users)")->fetchAll(PDO::FETCH_ASSOC);
$hasIsAdmin = false;

foreach ($columns as $column) {
    if (($column['name'] ?? '') === 'is_admin') {
        $hasIsAdmin = true;
        break;
    }
}

if (! $hasIsAdmin) {
    $db->exec('ALTER TABLE users ADD COLUMN is_admin BOOLEAN NOT NULL DEFAULT 0');
}

$userCount = (int) $db->query("SELECT COUNT(*) FROM users WHERE email = 'admin@silkyandsip.com'")->fetchColumn();

if ($userCount === 0) {
    $db->exec("INSERT INTO users (name, email, password, is_admin, created_at, updated_at) VALUES ('Admin Silky & SIP', 'admin@silkyandsip.com', '$2y$12$8aq5.Qnz4k9F/uuzbPm4EeNazN8e7qIyJDm0Fy4NZJxU9gPsx.LYW', 1, datetime('now'), datetime('now'))");
} else {
    $db->exec("UPDATE users SET is_admin = 1, password = '$2y$12$8aq5.Qnz4k9F/uuzbPm4EeNazN8e7qIyJDm0Fy4NZJxU9gPsx.LYW', name = 'Admin Silky & SIP' WHERE email = 'admin@silkyandsip.com'");
}

echo "Admin database ready\n";
