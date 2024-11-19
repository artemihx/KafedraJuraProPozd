<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/echo', [Controller\Api::class, 'echo']);

Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('POST', '/signup', [Controller\Api::class, 'signup']);
Route::add('GET', '/products', [Controller\Api::class, 'products']);
Route::add('GET', '/logout', [Controller\Api::class, 'logout']);
