<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ShortUrlController;
use App\Http\Controllers\Web\CompanyWebController;
use App\Http\Controllers\Web\UserWebController;

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
    return view('welcome');
});

// Public route for redirection
Route::get('/{short_code}', [ShortUrlController::class, 'redirect'])->name('short_url.redirect');

// Authenticated routes for management
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->prefix('web')
    ->name('web.')
    ->group(function () {
        // ... (other web routes like companies.index, etc.)
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::resource('companies', CompanyWebController::class);

        Route::resource('users', UserWebController::class);

        // Short URL Management Routes
        Route::resource('short_urls', ShortUrlController::class);
    });
