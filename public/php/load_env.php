<?php
// Simple .env loader for PHP
// Looks for a .env file in project root (two levels up from public/php) or in the same directory.
// Loads KEY=VALUE pairs into getenv(), $_ENV and $_SERVER if not already set.

$possiblePaths = [
    realpath(__DIR__ . '/../../') . '/.env', // project root
    __DIR__ . '/.env', // fallback in public/php
];

foreach ($possiblePaths as $envPath) {
    if ($envPath && file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) continue;
            if (strpos($line, '=') === false) continue;
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            // remove surrounding quotes
            if (strlen($value) > 1 && (($value[0] === '"' && substr($value, -1) === '"') || ($value[0] === "'" && substr($value, -1) === "'"))) {
                $value = substr($value, 1, -1);
            }
            if (getenv($name) === false) {
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
        break;
    }
}
