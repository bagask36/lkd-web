<?php

$output = [];
$command = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(dirname(__DIR__) . '/artisan') . ' storage:link 2>&1';
exec($command, $output, $exitCode);

header('Content-Type: text/plain; charset=utf-8');
http_response_code($exitCode === 0 ? 200 : 500);
echo implode("\n", $output);
