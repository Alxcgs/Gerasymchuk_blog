<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;

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
});

//Адмінка
$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group($groupData, function () {
    //BlogCategory
    $methods = ['index','edit','store','update','create',];
    Route::resource('categories', CategoryController::class)
    ->only($methods)
    ->names('blog.admin.categories'); 
 });

Route::group([ 'namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});
