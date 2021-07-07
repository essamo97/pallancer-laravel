<?php

use App\http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\admin\UsersController;
use Illuminate\Support\Facades\Route;
// git add.
//  git commit -m ""
//   git push origin master

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [App\Http\controller\DashboardController::class, 'index']);


Route::group([
    'prefix' => 'admin/categories',
    'as' => 'admin.categories.',
], function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('create');
    Route::get('/{id}', [CategoriesController::class, 'show'])->name('show');
    Route::post('/', [CategoriesController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoriesController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
});
Route::get('admin/users/{id}', [UsersController::class, 'show'])->name('admin.users.show');

// Route::resource('admin/categories', 'Admin\CategoriesController');

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';*/
// Route::get('regexp', function () {
//     $test = '059-1235667 , 059-2753338 ,059-2222222';
//     $exp = '/^(059|056)\-?([0-9]{7})$/';

//     $pattern ='/[a-zA-Z0-9]+[a-zA-Z0-9\.\.\-_/]*@/';

//     preg_match_all($exp, $test, $matches);
//     dd($matches);
// });
