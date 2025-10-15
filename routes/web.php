<?php
use App\Http\Controllers\Web\CompanyWebController;

use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Companies web CRUD routes
    Route::resource('companies', CompanyWebController::class, [
        'names' => [
            'index' => 'web.companies.index',
            'create' => 'web.companies.create',
            'store' => 'web.companies.store',
            'show' => 'web.companies.show',
            'edit' => 'web.companies.edit',
            'update' => 'web.companies.update',
            'destroy' => 'web.companies.destroy',
        ]
    ]);
});