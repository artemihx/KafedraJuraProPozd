<?php
declare(strict_types=1);

try {
    $app = require_once __DIR__ . '/../core/bootstrap.php';
    $app->run();
} catch (Throwable $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre';
}