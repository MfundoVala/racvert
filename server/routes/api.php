<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganisationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::middleware("auth:sanctum")->group(function () {
Route::get('/update', [UserController::class, 'updateProfile']);
Route::get('/user', [UserController::class, 'getProfile']);
Route::post('/add_organisation/{user_id}', [OrganisationController::class, 'create']);
Route::put('/update_organisation/{user_id}', [OrganisationController::class, 'update']);
Route::delete('/delete_organisation/{user_id}', [OrganisationController::class, 'delete']);
Route::get('/organisations', [OrganisationController::class, 'getOrganisations']);
});


Route::middleware("auth:sanctum")->group(function () {
    Route::get("organisations", [OrganisationController::class, "getOrganisations"]);
    Route::post("add_organisation", [OrganisationController::class, "create"]);
    Route::put("update_organisation/{id}", [OrganisationController::class, "update"]);
    Route::delete("delete_organisation/{id}", [OrganisationController::class, "delete"]);
});

