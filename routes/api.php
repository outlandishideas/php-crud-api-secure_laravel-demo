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
use Outlandish\PhpCrudApi\TablePermissions;

Route::any('{any}', function (ServerRequestInterface $request) {

    class UsersTablePermissions extends TablePermissions
    {
        public function __construct()
        {
            parent::__construct('users');
            $this->allReadColumns = ["id", "display_name"];
        }
    }

    class PetsTablePermissions extends TablePermissions
    {
        public function __construct()
        {
            parent::__construct('pets');
            $this->allReadColumns = ["id", "name", "favourite_food", "species", "owner"];
            $this->createColumns = ["name", "favourite_food", "species", "owner"];
        }
    }

    $tablePermissions = [
        PetsTablePermissions::getInstance(),
        UsersTablePermissions::getInstance()
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
    ], $tablePermissions);

    $api = new Api($config);
    $response = $api->handle($request);

    return $response;
})->where('any', '.*');

