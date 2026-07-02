<?php
// Load .env file if it exists (local development)
$env_file = __DIR__ . '/../.env';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            [$key, $val] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($val);
            putenv(trim($key) . '=' . trim($val));
        }
    }
}

// Database credentials — Railway injects these as real env vars in production
$db_host = getenv('DB_HOST') ?: (getenv('MYSQLHOST')     ?: 'localhost');
$db_user = getenv('DB_USER') ?: (getenv('MYSQLUSER')     ?: 'root');
$db_pass = getenv('DB_PASS') ?: (getenv('MYSQLPASSWORD') ?: '');
$db_name = getenv('DB_NAME') ?: (getenv('MYSQLDATABASE') ?: 'investcl_slot');

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$koneksi) {
    // Fail gracefully — don't expose error details in production
    $is_production = (getenv('APP_ENV') === 'production');
    die($is_production ? 'Service temporarily unavailable.' : 'DB Error: ' . mysqli_connect_error());
}

/**
 * Format number in Indian numbering format (e.g., 1,00,000)
 */
function format_indian_currency($number, $decimals = 0) {
    $number = (float)$number;
    $is_negative = $number < 0;
    $number = abs($number);

    $parts = explode('.', number_format($number, $decimals, '.', ''));
    $integer_part = $parts[0];
    $decimal_part = isset($parts[1]) && strlen($parts[1]) > 0 ? '.' . $parts[1] : '';

    $last_three   = substr($integer_part, -3);
    $other_digits = substr($integer_part, 0, -3);

    if ($other_digits != '') {
        $last_three = ',' . $last_three;
    }

    $formatted_integer = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $other_digits) . $last_three;
    return ($is_negative ? '-' : '') . $formatted_integer . $decimal_part;
}
?>
