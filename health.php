<?php
// Deployment health check - DELETE after verifying
header('Content-Type: text/plain');

echo "=== Railway Health Check ===\n\n";

// PHP Info
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server: " . php_uname() . "\n\n";

echo "mysqli extension loaded: " . (extension_loaded('mysqli') ? "YES" : "NO") . "\n";
echo "pdo_mysql extension loaded: " . (extension_loaded('pdo_mysql') ? "YES" : "NO") . "\n\n";

// Environment Variables
echo "=== DB Environment Variables ===\n";
$vars = ['DB_HOST','DB_USER','DB_PASS','DB_NAME','MYSQLHOST','MYSQLUSER','MYSQLPASSWORD','MYSQLDATABASE','MYSQLPORT','APP_ENV'];
foreach ($vars as $v) {
    $val = getenv($v);
    if ($v === 'DB_PASS' || $v === 'MYSQLPASSWORD') {
        echo "$v = " . ($val ? '***SET***' : '(not set)') . "\n";
    } else {
        echo "$v = " . ($val ?: '(not set)') . "\n";
    }
}

// DB Connection Test
echo "\n=== Database Connection ===\n";
$host = getenv('DB_HOST') ?: (getenv('MYSQLHOST')     ?: 'localhost');
$user = getenv('DB_USER') ?: (getenv('MYSQLUSER')     ?: 'root');
$pass = getenv('DB_PASS') ?: (getenv('MYSQLPASSWORD') ?: '');
$name = getenv('DB_NAME') ?: (getenv('MYSQLDATABASE') ?: 'railway');
$port = getenv('MYSQLPORT') ?: 3306;

echo "Connecting to: $host:$port / $name as $user\n";

if (extension_loaded('mysqli')) {
    $conn = @new mysqli($host, $user, $pass, $name, (int)$port);
    if ($conn->connect_error) {
        echo "FAILED: " . $conn->connect_error . "\n";
    } else {
        echo "SUCCESS!\n";
        $r = $conn->query("SHOW TABLES");
        $tables = [];
        while ($row = $r->fetch_row()) $tables[] = $row[0];
        echo "Tables (" . count($tables) . "): " . implode(', ', $tables) . "\n";
        $conn->close();
    }
} else {
    echo "FAILED: mysqli extension is missing!\n";
}

echo "\nDone.";
?>
