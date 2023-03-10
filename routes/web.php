<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
// use App\Http\Controllers\LogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Auth\AuthController;

// Auth process

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('showRegister');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('saveRegister');

// recipe list page
Route::get('/recipes/list', [RecipeController::class, 'list'])
    ->name('recipes.list');

Route::group(['middleware' => ['guest']], function() {


    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('showLogin');

    Route::post('login', [AuthController::class, 'login'])
        ->name('login');

});



Route::group(['middleware' => ['auth']], function() {

    // logout

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');


    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('categories.show')
        ->where('category', '[0-9]+');

    Route::post('/categories/store', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::patch('/categories/{category}/update', [CategoryController::class, 'update'])
        ->name('categories.update')
        ->where('category', '[0-9]+');

    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])
        ->name('categories.destroy')
        ->where('category', '[0-9]+');

    Route::patch('/categories/{category}/checked', [CategoryController::class, 'checked'])
        ->name('categories.checked')
        ->where('category', '[0-9]+');

    Route::delete('/categories/purge', [CategoryController::class, 'purge'])
        ->name('categories.purge');

    Route::patch('/categories/{category}/upto', [CategoryController::class, 'upto'])
        ->name('categories.upto')
        ->where('category', '[0-9]+');

    Route::patch('/categories/{category}/downto', [CategoryController::class, 'downto'])
        ->name('categories.downto')
        ->where('category', '[0-9]+');

    // category???????????????recipe?????????
    Route::post('/categories/{category}/recipes', [RecipeController::class, 'store'])
        ->name('recipes.store')
        ->where('category', '[0-9]+');

    Route::delete('/recipes/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // Route::delete('/categories/{recipe}/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // ???????????????????????????????????????????????????????????????????????????????????????????????????
    // dotinstall????????????/recipes/{recipe}/destroy?????????????????????
        ->name('recipes.destroy')
        ->where('recipe', '[0-9]+');

});

// ?????????????????????????????????
Route::prefix('password_reset')->name('password_reset.')->group(function () {
    Route::prefix('email')->name('email.')->group(function () {
        // ???????????????????????????????????????????????????????????????
        Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
        // ?????????????????????
        Route::post('/', [PasswordController::class, 'sendEmailResetPassword'])->name('send');
        // ??????????????????????????????
        Route::get('/send_complete', [PasswordController::class, 'sendComplete'])->name('send_complete');
    });
    // ?????????????????????????????????
    Route::get('/edit', [PasswordController::class, 'edit'])->name('edit');
    // ???????????????????????????
    Route::post('/update', [PasswordController::class, 'update'])->name('update');
    // ????????????????????????????????????
    Route::get('/edited', [PasswordController::class, 'edited'])->name('edited');
});







