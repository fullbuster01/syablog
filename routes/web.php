<?php

use Illuminate\Support\Facades\Auth;
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





Route::group(
    ['namespace' => 'Admin',  'prefix' => 'admin', 'middleware' => 'auth'],
    function () {
        Route::group(['middleware' => ['role:administrator']], function () {
            // Route::
            Route::get('dashboard', 'DashboardController@index')->name('dashboard');

            Route::get('categoryAjax', 'CategoryController@data_ajax')->name('category.ajax');
            Route::resource('category', 'CategoryController');
            Route::get('tagAjax', 'TagController@data_ajax')->name('tag.ajax');
            Route::resource('tag', 'TagController');
            Route::get('userAjax', 'UserController@data_ajax')->name('user.ajax');
            Route::resource('user', 'UserController');

            Route::get('postAjax', 'PostController@data_ajax')->name('post.ajax');
            Route::get('post/hapus', 'PostController@tampil_hapus')->name('post.hapus');
            Route::get('post/restore/{id}', 'PostController@restore')->name('post.restore');
            Route::delete('post/kill/{id}', 'PostController@kill')->name('post.kill');
            Route::resource('post', 'PostController');

            Route::get('thumbAjax', 'ThumbnailController@data_ajax')->name('thumb.ajax');
            Route::resource('thumbnail', 'ThumbnailController');

            Route::get('profile', 'ProfileController@index')->name('profile');
        });
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('postAjax', 'PostController@data_ajax')->name('post.ajax');
        Route::get('post/hapus', 'PostController@tampil_hapus')->name('post.hapus');
        Route::get('post/restore/{id}', 'PostController@restore')->name('post.restore');
        Route::delete('post/kill/{id}', 'PostController@kill')->name('post.kill');
        Route::resource('post', 'PostController');
        Route::get('thumbAjax', 'ThumbnailController@data_ajax')->name('thumb.ajax');
        Route::resource('thumbnail', 'ThumbnailController');
        Route::get('profile', 'ProfileController@index')->name('profile');

    }
);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function() {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    Route::view('/image', 'pages.admin.post.image');
    Route::view('/file', 'pages.admin.post.file');
});


Auth::routes(['register' => false, 'password/reset' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/all-post', 'HomeController@all_post')->name('all.post');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/{slug}', 'HomeController@post')->name('post');
Route::get('/category/{category:slug}', 'HomeController@category')->name('category');
Route::get('/tag/{tag:slug}', 'HomeController@tag')->name('tag');


