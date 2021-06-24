<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Outlandish\PhpCrudApi\SecureConfig;

Route::any('{any}', function (ServerRequestInterface $request) {

    /* READ ONLY CONFIG */
//    $table_columns_mapping = [
//        "users" =>
//            ["id", "display_name"],
//        "pets" =>
//            ["id", "name", "favourite_food", "species", "owner"]
//    ];

    /* SEPARATE WRITE AND READ CONFIG */
    $table_columns_mapping = [
        "read" => [
            "users" =>
                ["id", "display_name"],
            "pets" =>
                ["id", "name", "favourite_food", "species", "owner"]
        ],
        "write" => [
            "pets" =>
                ["id", "name", "favourite_food", "species", "owner"]
        ]
    ];

    $config = new SecureConfig([
        'username' => '',
        'password' => '',
        'address' => base_path() . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "animals.sqlite",
        'database' => 'main',
        'driver' => 'sqlite',
        'basePath' => '/api',
        'middlewares' => 'apiKeyAuth,authorization',
        'apiKeyAuth.keys' => 'password1234,secretAPIkey',
        'apiKeyAuth.mode' => 'optional',
    ], $table_columns_mapping);

    $api = new Api($config);
    $response = $api->handle($request);

    return $response;
})->where('any', '.*');

