<?php

use App\Http\Controllers\API\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TaskController::class)->group(function () {

        Route::get('/', function () {
            return 'Essa rota não está disponível.';
        });

        Route::prefix('v1')->group(function () {

            Route::get('get-tasks', 'index');
            Route::get('get-task/{id}', 'show');
            Route::post('store-task', 'store');
            Route::put('update-task/{id}', 'update');
            Route::post('delete-task', 'delete');
        });

});
