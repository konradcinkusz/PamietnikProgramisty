<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Dla wszystkich niezalogowanych userów Fetch categories and events
    $categories = \App\Models\Category::all();
    $events = \App\Models\Event::all();

    return view('events', ['categories' => $categories, 'events' => $events]);
});

//User releated routs
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Categories related routes
Route::post('/create-category', [CategoryController::class, 'createCategory']);
Route::get('/edit-category/{category}', [CategoryController::class, 'editCategory']);
Route::put('/edit-category/{category}', [CategoryController::class, 'updateCategory']);
Route::delete('/delete-category/{category}', [CategoryController::class, 'deleteCategory']);

// Events related routes
Route::post('/create-event', [EventController::class, 'createEvent']);
Route::get('/edit-event/{event}', [EventController::class, 'showEditScreen']);
Route::get('/event-details/{event}', [EventController::class, 'showDetails']);
Route::put('/edit-event/{event}', [EventController::class, 'actuallyUpdateEvent']);
Route::delete('/delete-event/{event}', [EventController::class, 'deleteEvent']);
Route::get('/admin-seed', [EventController::class, 'seedData']);
