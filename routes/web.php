<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Guest\PostController@index')->name('guest.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/posts', 'User\PostController');
Route::get('/admin/posts', 'Admin\PostController@index')->name('admin.posts.all');
Route::get('/admin/profile', 'Admin\UserController@index')->name('admin.profile.edit');
Route::put('/admin/profile/avatar', 'Admin\UserController@avatarUpload')->name('admin.profile.avatar');

Route::get('/profile', 'User\UserController@index')->middleware(['auth'])->name('profile.edit');
Route::put('/profile/avatar', 'User\UserController@avatarUpload')->middleware(['auth'])->name('profile.avatar');

require __DIR__.'/auth.php';
