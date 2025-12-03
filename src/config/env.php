<?php

$envPath = __DIR__ . '/.env';

if (!file_exists($envPath)) {
    die(".env não encontrado!");
}

$vars = parse_ini_file($envPath);

foreach ($vars as $key => $value) {
    putenv("$key=$value");
}
