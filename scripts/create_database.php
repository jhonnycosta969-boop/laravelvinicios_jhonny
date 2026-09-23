<?php
require __DIR__ . '/../vendor/autoload.php';

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    echo ".env not found\n";
    exit(1);
}

$env = file_get_contents($envPath);
preg_match('/DB_CONNECTION=(.*)/', $env, $m);
$driver = isset($m[1]) ? trim($m[1]) : 'mysql';
preg_match('/DB_HOST=(.*)/', $env, $m);
$host = isset($m[1]) ? trim($m[1], " \t\r\n\"") : '127.0.0.1';
preg_match('/DB_PORT=(.*)/', $env, $m);
$port = isset($m[1]) ? trim($m[1], " \t\r\n\"") : '3306';
preg_match('/DB_USERNAME=(.*)/', $env, $m);
$user = isset($m[1]) ? trim($m[1], " \t\r\n\'") : 'root';
preg_match('/DB_PASSWORD=(.*)/', $env, $m);
$pass = isset($m[1]) ? trim($m[1], " \t\r\n\'") : '';

$dbname = 'robotica_tml';

try {
    if ($driver === 'sqlite') {
        echo "SQLite selected; file-based DB creation not applicable.\n";
        exit(1);
    }

    $dsn = "mysql:host={$host};port={$port}";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database '{$dbname}' created or already exists.\n";
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Update .env DB_DATABASE value
$newEnv = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE={$dbname}", $env, 1, $count);
if ($count === 0) {
    $newEnv = rtrim($env, "\r\n") . "\nDB_DATABASE={$dbname}\n";
}
file_put_contents($envPath, $newEnv);
echo ".env updated with DB_DATABASE={$dbname}\n";

return 0;
